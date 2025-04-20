<?php

namespace Database\Seeders;

use App\Models\JenisKarya;
use App\Models\Paket;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class SenimanTableSeeder2 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Daftar pengguna yang akan ditambahkan
        $users = [
            [
                'name' => 'Dwiyan Julianto',
                'whatsapp' => '085311387669',
                'email' => 'radisti.20@gmail.com',
                'paket_id' => 1, // Basic
                'jenis_karya' => 2, // Ilustrasi
                'subkategori' => 10, // Anggap: kategori khusus untuk kebutuhanmu
            ],
            [
                'name' => 'Hilda Azalya Christa',
                'whatsapp' => '081221568932',
                'email' => 'hildaazalya@gmail.com',
                'paket_id' => 2, // Professional
                'jenis_karya' => 1, // Fine Art
                'subkategori' => 2, // Skets
            ],
            [
                'name' => 'Wahyu Setiono',
                'whatsapp' => '083127502617',
                'email' => 'setionow8@gmail.com',
                'paket_id' => 2, // Professional
                'jenis_karya' => 2, // Digital Art
                'subkategori' => 6, // Anggap: Digital Art (atau sesuaikan dengan yang tersedia)
            ],
        ];

        foreach ($users as $userData) {
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
                    'role_id' => 3,
                    'alamat' => '',
                    'whatsapp' => $userData['whatsapp'],
                    'id_seniman' => $idSeniman,
                    'profile_pic' => null,
                    'jenis_karya' => $userData['jenis_karya'],
                    'subkategori' => $userData['subkategori'],
                    'paket_id' => $userData['paket_id'],
                    'deskripsi_diri' => null,
                    'exhibition_experience' => null,
                    'ss_pembayaran' => null,
                    'status' => 'active',
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
        $paketInitials = strtoupper(substr($paketName, 0, 3));
        $jenisKaryaInitials = strtoupper(substr($jenisKaryaName, 0, 3));
        $uniqueNumber = mt_rand(100, 999);
        $month = Carbon::now()->format('m');
        $year = Carbon::now()->format('y');
        return "{$uniqueNumber}_{$paketInitials}{$jenisKaryaInitials}_{$month}{$year}";
    }
}
