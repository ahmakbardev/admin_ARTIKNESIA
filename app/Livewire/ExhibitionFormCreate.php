<?php

namespace App\Livewire;

use App\Models\Exhibition;
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
            'link' => 'nullable|url',
        ];
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
            return;
        }

        $customFileName = $this->slug . '-' . time() . '.' . $this->banner->getClientOriginalExtension();

        // Store file with custom name in public/images/exhibitions directory
        $filePath = Storage::disk('public')->putFileAs(
            'exhibitions',
            $this->banner,
            $customFileName
        );

        $validated['banner'] = $filePath;

        Exhibition::create($validated);

        session()->flash('success', 'Pameran berhasil ditambahkan');
        return redirect()->route('admin.exhibition.index');
    }

    public function render()
    {
        return view('livewire.exhibition-form-create');
    }
}