<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\ArticleTag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $user = Auth::user();
        $articles = Article::query()->with(['author:id,name'])->select('id', 'title', 'author_id', 'status', 'created_at', 'slug');
        if ($user->role->nama === 'writer') {
            $articles = $articles->where('author_id', $user->id)->get();
        } else {
            $articles = $articles->get();
        }

        return view('admin.article.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = ArticleCategory::all();
        $tags = ArticleTag::all();

        return view('admin.article.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'short_title' => 'string',
            'slug' => 'required|string|unique:articles,slug',
            'description' => 'string',
            'short_description' => 'string',
            'meta_title' => 'string',
            'meta_description' => 'string',
            'meta_robots' => 'string',
            'language' => 'string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:1024',
            'image_caption' => 'string',
            'status' => 'string',
            'tags' => 'array',
            'categories' => 'array',
        ]);

        // #[Tags] Insert & Get ID
        $tags = $request->input('tags');
        $validated['tags'] = $this->insertRelation($tags, 'tags');

        // #[Category] Insert & Get ID
        $categories = $request->input('categories');
        $validated['categories'] = $this->insertRelation($categories, 'categories');

        // #[Image Upload] Checking image & upload in storage
        if ($request->hasFile('image')) {
            $file = $request->file('image')->store('media', 'public');
            $validated['image'] = $file;
        }

        $validated['author_id'] = Auth::id();

        Article::query()->create($validated);

        return redirect()->route('admin.article.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article): View
    {
        return view('admin.article.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article): View
    {
        $categories = ArticleCategory::all();
        $tags = ArticleTag::all();

        return view('admin.article.edit', compact('article', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'short_title' => 'string',
            'slug' => "required|string|unique:articles,slug,$article->id,id",
            'description' => 'string',
            'short_description' => 'string',
            'meta_title' => 'string',
            'meta_description' => 'string',
            'meta_robots' => 'string',
            'language' => 'string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:1024',
            'image_caption' => 'string',
            'status' => 'string',
            'tags' => 'array',
            'categories' => 'array',
        ]);

        // #[Tags] Insert & Get ID
        $tags = $request->input('tags');
        $validated['tags'] = $this->insertRelation($tags, 'tags');

        // #[Category] Insert & Get ID
        $categories = $request->input('categories');
        $validated['categories'] = $this->insertRelation($categories, 'categories');

        // #[Image Upload] Checking image & upload in storage
        if ($request->hasFile('image')) {

            $file = $request->file('image')->store('media', 'public');
            $validated['image'] = $file;
        } else {
            $validated['image'] = $article->image;
        }

        $article->update($validated);

        return redirect()->route('admin.article.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article): RedirectResponse
    {
        $article->delete();
        return redirect()->route('admin.article.index');
    }

    /**
     * Insert new categories or tags into the database and return their IDs.
     *
     * This function handles the insertion of new items (identified by names
     * starting with 'new-') and retrieves existing item IDs based on the
     * provided value. It merges both newly inserted and existing IDs
     * before returning them.
     *
     * @param array $value An array of category or tag names (or IDs)
     *                     to be processed for insertion.
     * @param string $table The name of the table ('categories' or 'tags')
     *                      to determine the insertion logic.
     *
     * @return array An array containing the IDs of both newly inserted
     *               and existing categories or tags.
     */
    private function insertRelation(array $value, string $table): array
    {
        return match ($table) {
            'categories' => $this->insertOrUpdate('categories', $value, ArticleCategory::class),
            'tags' => $this->insertOrUpdate('tags', $value, ArticleTag::class),
            default => [],
        };
    }

    /**
     * Insert new items or update existing ones in the specified model.
     *
     * This function processes an array of values, separating new items (identified
     * by names starting with 'new-') from existing ones. It inserts new items into
     * the database and retrieves the IDs of both newly inserted and existing items,
     * returning them as a merged array.
     *
     * @param string $type The type of items being processed ('categories' or 'tags').
     * @param array $value An array of category or tag names (or IDs) to be processed for insertion.
     * @param string $model The model class name to which the items will be inserted (e.g., ArticleCategory::class).
     *
     * @return array An array containing the IDs of both newly inserted and existing items.
     */
    private function insertOrUpdate(string $type, array $value, string $model): array
    {
        // Separate new and existing items
        $newItems = array_map(fn($item) => ['name' => str_replace('new-', '', $item)],
            array_filter($value, fn($item) => str_starts_with($item, 'new')));
        $existingItems = array_filter($value, fn($item) => !str_starts_with($item, 'new'));

        // Insert new items and get their IDs
        if ($newItems) {
            $model::query()->insert($newItems);
            $insertedIds = $model::query()
                ->whereIn('name', array_column($newItems, 'name'))
                ->pluck('id')
                ->toArray();
        } else {
            $insertedIds = [];
        }

        // Get existing IDs
        $existingIds = $existingItems ? $model::query()->whereIn('id', $existingItems)->pluck('id')->toArray() : [];

        return array_merge($insertedIds, $existingIds);
    }

}
