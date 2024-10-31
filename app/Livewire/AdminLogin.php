<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AdminLogin extends Component
{
    public $email;
    public $password;

    public function render()
    {
        return view('livewire.admin-login');
    }

    public function login()
    {
        // Memeriksa apakah ada percobaan login sebelumnya yang gagal
        $failedAttempts = session('failed_login_attempts', 0);

        // Jika jumlah percobaan login yang gagal melebihi batas, beri pesan kesalahan
        if ($failedAttempts >= 10) {
            // Menghitung waktu penundaan dalam detik (60 detik = 1 menit)
            $delay = 60 * (1 + floor($failedAttempts / 10)); // Menambah 1 menit setiap 10 percobaan

            session()->flash('error', 'Anda telah mencoba login terlalu banyak. Silakan coba lagi setelah ' . $delay . ' detik.');
            return;
        }

        // Coba login dengan kredensial yang diberikan
        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];


        if (Auth::attempt($credentials)) {
            // Login sukses, arahkan ke halaman dashboard admin
            return redirect()->route('admin.dashboard');
        } else {
            // Login gagal, tambahkan satu kegagalan login ke sesi
            session(['failed_login_attempts' => $failedAttempts + 1]);

            // Tampilkan pesan kesalahan
            session()->flash('error', 'Email atau password salah.');
        }
    }
}
