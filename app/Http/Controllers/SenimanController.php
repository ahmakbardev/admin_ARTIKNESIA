<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SenimanController extends Controller
{
    public function index()
    {

        // Menghitung jumlah total pengguna dari tabel users dengan role_id == 3
        $seniman = User::where('role_id', 3)->get();

        // Mengirim data pengguna dan jumlah total pengguna ke view admin.index
        return view('admin.seniman.index', compact(
            'seniman'
        ));
    }
}
