<?php

namespace App\Livewire;

use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Component;

class TitleSlugComponent extends Component
{
    public string $title = '';
    public string $slug = '';

    public function mount($title = '', $slug = ''): void
    {
        if ($title) {
            $this->title = $title;
        }
        if ($slug) {
            $this->slug = $slug;
        }
    }

    public function generateSlug(): void
    {
        $slug = Str::slug($this->title);
        $number = 2;
        while (Article::query()->where('slug', $slug)->exists()) {
            $slug = Str::slug($this->title . '-' . $number);
            $number++;
        }

        $this->slug = $slug;
    }

    public function render(): View
    {
        return view('livewire.title-slug-component');
    }
}
