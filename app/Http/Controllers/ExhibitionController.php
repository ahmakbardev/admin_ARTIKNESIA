<?php

namespace App\Http\Controllers;

use App\Models\Exhibition;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ExhibitionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $exhibitions = Exhibition::query()->paginate(10);

        return view('admin.exhibition.index', [
            'exhibitions' => $exhibitions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.exhibition.create', []);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
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
            'banner' => 'required|string|max:255',
            'organizer' => 'required|string|max:255',
            'status' => 'required|string|in:active,inactive',
            'link' => 'nullable|url',
        ]);

        Exhibition::query()->create($validated);

        return redirect()->route('admin.exhibition.index')->with('success', 'Pameran berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exhibition $exhibition): View
    {
        return view('admin.exhibition.edit', [
            'exhibition' => $exhibition
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exhibition $exhibition): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:exhibitions,slug,' . $exhibition->id,
            'description' => 'required|string',
            'category' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'price' => 'nullable|numeric|min:0',
            'banner' => 'required|string|max:255',
            'organizer' => 'required|string|max:255',
            'status' => 'required|string|in:active,inactive',
            'link' => 'nullable|url',
        ]);

        $exhibition->update($validated);

        return redirect()->route('admin.exhibition.index')->with('success', 'Pameran berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exhibition $exhibition): RedirectResponse
    {
        if (Storage::disk('public')->exists($exhibition->banner)) {
            Storage::disk('public')->delete($exhibition->banner);
        }
        $exhibition->delete();

        return redirect()->route('admin.exhibition.index')->with('success', 'Pameran berhasil dihapus');
    }
}
