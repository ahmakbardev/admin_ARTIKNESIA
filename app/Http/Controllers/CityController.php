<?php

namespace App\Http\Controllers;

use App\Models\MasterCity;
use App\Models\MasterProvince;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $cities = MasterCity::query()->paginate(10);
        return view('admin.city.index', [
            'cities' => $cities
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $provinces = MasterProvince::all();
        return view('admin.city.create', [
            'provinces' => $provinces
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'province_id' => 'required',
            'name' => 'required',
        ]);

        MasterCity::query()->create($validated);

        return to_route('admin.city.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MasterCity $city): View
    {
        $provinces = MasterProvince::all();
        return view('admin.city.edit', [
            'city' => $city,
            'provinces' => $provinces
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MasterCity $city): RedirectResponse
    {
        $validated = $request->validate([
            'province_id' => 'required',
            'name' => 'required',
        ]);

        $city->update($validated);
        return to_route('admin.city.index')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MasterCity $city): RedirectResponse
    {
        $city->delete();
        return to_route('admin.city.index')->with('success', 'Data berhasil dihapus');
    }
}
