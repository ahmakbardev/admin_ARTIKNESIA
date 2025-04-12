<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Tambahkan user admin
//        User::create([
//            'name' => 'admin_artiknesia',
//            'username' => 'admin_artiknesia',
//            'alamat' => '',
//            'paket_id' => '1',
//            'email' => 'artiknesia.id@gmail.com',
//            'password' => Hash::make('Artiknesia.id123980'),
//            'role_id' => 1, // Role ID untuk admin
//        ]);
        User::firstOrCreate(
            [
                'name' => 'Bariq Firjatullah'
            ],
            [
                'username' => 'bariqfirjatullah',
                'alamat' => '',
                'paket_id' => '1',
                'email' => 'bariqfirjatullah1803@gmail.com',
                'password' => Hash::make('bariq123321'),
                'role_id' => 1,
                // Role ID untuk admin
            ]
        );
    }
}
