<?php

namespace App\Livewire;

use App\Models\Exhibition;
use App\Models\MasterCity;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class ExhibitionFormCreate extends Component
{
    use WithFileUploads;

    public $name = '';
    public $slug = '';
    public $description = '';
    public $category = '';
    public $city = '';
    public $address = '';
    public $type = '';
    public $start_date = '';
    public $end_date = '';
    public $price = 0;
    public $banner;  // Changed to handle file upload
    public $exhibition_images = [];
    public $new_image;
    public $link_vidio = '';
    public $embed_link = '';
    public $organizer = '';
    public $status = 'active';
    public $link = '';
    public $slugError = '';

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:exhibitions,slug',
            'description' => 'required|string',
            'category' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'price' => 'nullable|numeric|min:0',
            'banner' => 'required|image|max:1024', // Changed validation rule for image
            'organizer' => 'required|string|max:255',
            'status' => 'required|string|in:active,inactive',
            'link' => 'required|url',
            'link_vidio' => 'nullable|string|url',
            'exhibition_images' => 'required|array|min:1|max:3'
        ];
    }

    public function updatedNewImage()
    {
        if (count($this->exhibition_images) >= 3) {
            $this->addError('exhibition_images', 'Maksimal 3 gambar boleh ditambahkan');
            return;
        }

        $this->validate([
            'new_image' => 'image|max:1024',
        ]);

        $this->exhibition_images[] = $this->new_image;
    }

    public function removeImage($index)
    {
        unset($this->exhibition_images[$index]);
        $this->exhibition_images = array_values($this->exhibition_images);
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
        // Jika format youtu.be/xxxx
        if (Str::contains($url, 'youtu.be/')) {
            return str_replace('youtu.be/', 'www.youtube.com/embed/', $url);
        }

        return $url;
    }

    public function updatedName($value)
    {
        $this->validateOnly('name');
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

        $exists = Exhibition::where('slug', $this->slug)->exists();
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
            dump('pernah digunakan');
            return;
        }

        $customFileName = $this->slug . '-' . time() . '.' . $this->banner->getClientOriginalExtension();

        $filePath = Storage::disk('public')->putFileAs(
            'exhibitions',
            $this->banner,
            $customFileName
        );
        $validated['banner'] = $filePath;

        // For Multiple Image Galery
        $filePathMultipleImage = [];
        foreach ($this->exhibition_images as $index => $image) {
            $customFileName = $this->slug . '-' . time() . '-' . $index . '.' . $image->getClientOriginalExtension();
            $filePathGalery = Storage::disk('public')->putFileAs(
                'exhibitions/galery',
                $image,
                $customFileName
            );
            $filePathMultipleImage[] = ['image_path' => $filePathGalery];
        }
        $exhibition = Exhibition::create($validated);
        $exhibition->images()->createMany($filePathMultipleImage);


        session()->flash('success', 'Pameran berhasil ditambahkan');
        return redirect()->route('admin.exhibition.index');
    }

    public function render()
    {
        return view('livewire.exhibition-form-create', [
            'cities' => MasterCity::query()->with('province')->get()
        ]);
    }
}