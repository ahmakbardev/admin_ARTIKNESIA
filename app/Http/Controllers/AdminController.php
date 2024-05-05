<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Mengambil semua data pengguna dari tabel users
        $users = User::all();

        // Menghitung jumlah total pengguna dari tabel users
        $totalUsers = User::where('role_id', 4)->count();

        // Menghitung jumlah total pengguna dari tabel users dengan role_id == 3
        $totalSeniman = User::where('role_id', 3)->count();

        // Mengirim data pengguna dan jumlah total pengguna ke view admin.index
        return view('admin.index', compact(
            'users',
            'totalUsers',
            'totalSeniman'
        ));
    }
}
