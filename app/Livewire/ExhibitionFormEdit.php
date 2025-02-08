<?php

namespace App\Livewire;

use App\Models\Exhibition;
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
            'organizer' => 'required|string|max:255',
            'status' => 'required|string',
            'link' => 'nullable|url',
        ];
    }

    public function updatedName($value)
    {
        $this->validateOnly('name');
        if (empty($this->slug)) {
            $this->slug = Str::slug($value);
            $this->validateSlug();
        }
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

            $this->exhibition->update($validated);

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
