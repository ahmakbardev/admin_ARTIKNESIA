<?php

namespace App\Http\Controllers;

use App\Models\MasterProvince;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $provinces = MasterProvince::query()->paginate(10);

        return view('admin.province.index', [
            'provinces' => $provinces
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.province.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);

        MasterProvince::query()->create($validated);

        return to_route('admin.province.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MasterProvince $province): View
    {
        return view('admin.province.edit', [
            'province' => $province
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MasterProvince $province): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);

        $province->update($validated);

        return to_route('admin.province.index')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MasterProvince $province): RedirectResponse
    {
        $province->delete();

        return to_route('admin.province.index')->with('success', 'Data berhasil dihapus');
    }
}
