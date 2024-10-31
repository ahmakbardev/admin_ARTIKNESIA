<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class WriterController extends Controller
{
    /**
     * Showing data user with role writer
     * @return View to page admin/writer/index
     */
    public function index(): View
    {
        $role = Role::query()->where('nama', 'writer')->firstOrFail();
        $writers = User::query()->where('role_id', $role->id)->get();

        return view('admin.writer.index', compact('writers'));
    }

    /**
     * Showing form to create new user with role writer
     * @return View to page admin/writer/create
     */
    public function create(): View
    {
        return view('admin.writer.create');
    }

    /**
     * Logic business for create new user with role writer
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string',
        ]);

        $role = Role::query()->where('nama', 'writer')->firstOrFail();

        $validated['role_id'] = $role->id;
        $validated['email_verified_at'] = now();
        $validated['password'] = Hash::make($validated['password']);
        $validated['alamat'] = 'Malang';
        $validated['paket_id'] = Paket::query()->first()->id;

        User::query()->create($validated);

        return redirect()->route('admin.writer.index');
    }

    /**
     * Showing before editing data user with role writer
     * @param User $writer
     * @return View
     */
    public function edit(User $writer): View
    {
        return view('admin.writer.edit', compact('writer'));
    }

    /**
     * Logic process update selected data user with role writer
     * @param Request $request
     * @param User $writer
     * @return RedirectResponse
     */
    public function update(Request $request, User $writer): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => "required|unique:users,username,$writer->id",
            'email' => "required|email|unique:users,email,$writer->id",
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $writer->update($validated);

        return redirect()->route('admin.writer.index');
    }

    /**
     * Logic process delete selected data user with role writer
     * @param User $writer
     * @return RedirectResponse
     */
    public function destroy(User $writer): RedirectResponse
    {
        $writer->delete();

        return redirect()->route('admin.writer.index');
    }
}
