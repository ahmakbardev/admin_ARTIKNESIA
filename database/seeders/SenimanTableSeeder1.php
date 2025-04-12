<?php

namespace Database\Seeders;

use App\Models\JenisKarya;
use App\Models\Paket;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class SenimanTableSeeder1 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Daftar pengguna yang akan ditambahkan
        $users = [
            [
                'name' => 'Iqbal Albani',
                'whatsapp' => '082328219896',
                'email' => 'Iqbalalbani88@gmail.com',
                'paket_id' => 2, // Professional
                'jenis_karya' => 1, // Fine Art
                'subkategori' => 1, // Sketsa
            ],
        ];

        foreach ($users as $userData) {
            // Cek apakah email sudah ada untuk menghindari duplikasi
            $existingUser = User::where('email', $userData['email'])->first();
            if (!$existingUser) {
                $paket = Paket::find($userData['paket_id']);
                $jenisKarya = JenisKarya::find($userData['jenis_karya']);
                $idSeniman = $this->generateIdSeniman($paket->nama, $jenisKarya->nama);

                User::create([
                    'name' => $userData['name'],
                    'username' => 'Seniman_' . Str::uuid(),
                    'email' => $userData['email'],
                    'password' => Hash::make('senimanpassword'),
                    'role_id' => 3, // Seniman
                    'alamat' => '', // Sesuaikan atau isi sesuai kebutuhan
                    'whatsapp' => $userData['whatsapp'],
                    'id_seniman' => $idSeniman, // ID Seniman yang di-generate
                    'profile_pic' => null,
                    'jenis_karya' => $userData['jenis_karya'],
                    'subkategori' => $userData['subkategori'],
                    'paket_id' => $userData['paket_id'],
                    'deskripsi_diri' => null,
                    'exhibition_experience' => null,
                    'ss_pembayaran' => null,
                    'status' => 'active', // atau sesuai kebutuhan
                    'remember_token' => null,
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    // Method to generate id_seniman based on the specified format
    private function generateIdSeniman($paketName, $jenisKaryaName)
    {
        // Extract the first three letters of the paket name
        $paketInitials = strtoupper(substr($paketName, 0, 3));

        // Extract the first three letters of the jenis karya name
        $jenisKaryaInitials = strtoupper(substr($jenisKaryaName, 0, 3));

        // Generate a unique number (3 digits)
        $uniqueNumber = mt_rand(100, 999);

        // Get the current month and year
        $month = Carbon::now()->format('m');
        $year = Carbon::now()->format('y');

        // Combine the components to form id_seniman
        $idSeniman = "{$uniqueNumber}_{$paketInitials}{$jenisKaryaInitials}_{$month}{$year}";

        return $idSeniman;
    }
}
