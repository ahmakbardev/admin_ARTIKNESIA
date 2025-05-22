<?php

namespace App\Livewire;

use App\Models\Exhibition;
use App\Models\ExhibitionImage;
use App\Models\MasterCity;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class ExhibitionFormEdit extends Component
{
    use WithFileUploads;
    public Exhibition $exhibition;
    public $name;
    public $slug;
    public $description;
    public $category;
    public $city;
    public $address;
    public $type;
    public $start_date;
    public $end_date;
    public $price;
    public $banner;
    public $newBanner;
    public $organizer;
    public $status;
    public $link;
    public $slugError = '';
    public $exhibition_images = [];
    public $new_exhibition_images = [];
    public $new_image;
    public $link_vidio = '';
    public $embed_link = '';

    public function mount(Exhibition $exhibition)
    {
        $this->exhibition = $exhibition;
        $this->name = $exhibition->name;
        $this->slug = $exhibition->slug;
        $this->description = $exhibition->description;
        $this->category = $exhibition->category;
        $this->city = $exhibition->city;
        $this->address = $exhibition->address;
        $this->type = $exhibition->type;
        $this->start_date = $exhibition->start_date;
        $this->end_date = $exhibition->end_date;
        $this->price = $exhibition->price;
        $this->banner = $exhibition->banner;
        $this->organizer = $exhibition->organizer;
        $this->status = $exhibition->status;
        $this->link = $exhibition->link;
        $this->exhibition_images = $exhibition->images;
        $this->link_vidio = $exhibition->link_vidio;
        $this->updatedLinkVidio($exhibition->link_vidio);
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:exhibitions,slug,' . $this->exhibition->id,
            'description' => 'required|string',
            'category' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'price' => 'nullable|numeric|min:0',
            'newBanner' => 'nullable|image|max:1024|mimes:jpg,jpeg,png',
            'new_exhibition_images' => 'required|array|min:1|max:3',
            'organizer' => 'required|string|max:255',
            'status' => 'required|string',
            'link' => 'required|url',
            'link_vidio' => 'nullable|string|url',
        ];
    }

    public function updatedNewImage()
    {
        if (count($this->exhibition_images) + count($this->new_exhibition_images) >= 3) {
            $this->addError('new_exhibition_images', 'Maksimal 3 gambar boleh ditambahkan');
            return;
        }

        $this->validate([
            'new_image' => 'image|max:1024',
        ]);

        $this->new_exhibition_images[] = $this->new_image;
    }

    public function removeImage($index)
    {
        unset($this->new_exhibition_images[$index]);
        $this->new_exhibition_images = array_values($this->new_exhibition_images);
    }

    public function removeExhibitionImage($id_images)
    {
        // Menghapus Gambar di file dan database
        $exhibition_image = ExhibitionImage::find($id_images);
        if ($exhibition_image) {
            Storage::disk('public')->delete($exhibition_image->image_path);
            $exhibition_image->delete();
            $this->exhibition_images = $this->exhibition->images;
        }
    }

    public function updatedLinkVidio($value)
    {
        $this->validate([
            'link_vidio' => 'url'
        ]);
        $this->embed_link = $this->convertToEmbed($value);
    }
    public function convertToEmbed($url)
    {
        if (Str::contains($url, 'youtu.be/')) {
            return str_replace('youtu.be/', 'www.youtube.com/embed/', $url);
        }
        return $url;
    }

    public function updatedName($value)
    {

        $this->slug = Str::slug($value);
        $this->validateSlug();

    }

    public function updatedSlug($value)
    {
        $this->slug = Str::slug($value);
        $this->validateSlug();
    }

    public function validateSlug()
    {
        $this->slugError = '';

        if (empty($this->slug)) {
            $this->slugError = 'Slug tidak boleh kosong.';
            return false;
        }

        $exists = Exhibition::where('slug', $this->slug)
            ->where('id', '!=', $this->exhibition->id)
            ->exists();

        if ($exists) {
            $this->slugError = 'Slug sudah digunakan.';
            return false;
        }

        return true;
    }

    public function submit()
    {
        $validated = $this->validate();

        if (!$this->validateSlug()) {
            return;
        }

        try {
            if ($this->newBanner) {
                if ($this->banner && Storage::disk('public')->exists($this->banner)) {
                    Storage::disk('public')->delete($this->banner);
                }

                $customFileName = $this->slug . '-' . time() . '.' . $this->newBanner->getClientOriginalExtension();
                $filePath = Storage::disk('public')->putFileAs(
                    'exhibitions',
                    $this->newBanner,
                    $customFileName
                );

                $validated['banner'] = $filePath;
            }

            unset($validated['newBanner']);
            // For Multiple Image Galery
            $filePathMultipleImage = [];
            foreach ($this->new_exhibition_images as $index => $image) {
                $customFileName = $this->slug . '-' . time() . '-' . $index . '.' . $image->getClientOriginalExtension();
                $filePathGalery = Storage::disk('public')->putFileAs(
                    'exhibitions/galery',
                    $image,
                    $customFileName
                );
                $filePathMultipleImage[] = ['image_path' => $filePathGalery];
            }
            $this->exhibition->update($validated);
            $this->exhibition->images()->createMany($filePathMultipleImage);


            session()->flash('success', 'Pameran berhasil diperbarui');
            return redirect()->route('admin.exhibition.index');

        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat memperbarui data.');
            return;
        }
    }

    public function render()
    {
        return view('livewire.exhibition-form-edit', [
            'cities' => MasterCity::query()->with('province')->get()
        ]);
    }
}
