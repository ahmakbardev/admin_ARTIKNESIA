<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected $casts = [
        'categories' => 'array',
        'tags' => 'array'
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function tags(): array|Collection
    {
        return ArticleTag::query()->whereIn('id', $this->tags ?? [])->pluck('name') ?? [];
    }

    public function categories(): array|Collection
    {
        return ArticleTag::query()->whereIn('id', $this->tags ?? [])->pluck('name') ?? [];
    }
}
