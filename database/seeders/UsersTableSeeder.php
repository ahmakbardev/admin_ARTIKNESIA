<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Paket;
use App\Models\JenisKarya;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Daftar pengguna yang akan ditambahkan
        $users = [
            [
                'name' => 'Bobby Setiaji',
                'whatsapp' => '081316287958',
                'email' => 'bzlavey@gmail.com',
                'paket_id' => 2, // Professional
                'jenis_karya' => 1, // Fine Art
                'subkategori' => 2, // Sketsa
            ],
            [
                'name' => 'Muhammad Aziz Al Jabbar',
                'whatsapp' => '0895395173612',
                'email' => 'azizaljab@gmail.com',
                'paket_id' => 1, // Pemula
                'jenis_karya' => 1, // Fine Art
                'subkategori' => 1, // Lukis
            ],
            [
                'name' => 'Rian Yogo Wibowo',
                'whatsapp' => '085785558504',
                'email' => 'rianyogo@gmail.com',
                'paket_id' => 1, // Pemula
                'jenis_karya' => 1, // Fine Art
                'subkategori' => 1, // Lukis
            ],
            [
                'name' => 'Ahmad Abdillah',
                'whatsapp' => '085724619539',
                'email' => 'iskandarabdillah29@gmail.com',
                'paket_id' => 1, // Pemula
                'jenis_karya' => 2, // Digital Art
                'subkategori' => 5, // Grafis
            ],
            [
                'name' => 'Arif Rahman Setiadi',
                'whatsapp' => '087841724365',
                'email' => 'arifsetiadi68@gmail.com',
                'paket_id' => 2, // Professional
                'jenis_karya' => 1, // Fine Art
                'subkategori' => 1, // Lukis
            ],
            [
                'name' => 'Endik Asto',
                'whatsapp' => '083830807442',
                'email' => 'astoendik@gmail.com',
                'paket_id' => 2, // Professional
                'jenis_karya' => 1, // Fine Art
                'subkategori' => 1, // Lukis
            ],
            [
                'name' => 'Ajeng Ritzki Pitakasari',
                'whatsapp' => '081932191100',
                'email' => 'arpitakasari@gmail.com',
                'paket_id' => 2, // Professional
                'jenis_karya' => 1, // Fine Art
                'subkategori' => 1, // Lukis
            ],
            [
                'name' => "Hasna Muthi'ah",
                'whatsapp' => '0895326658446',
                'email' => 'hasna.muthiah04@gmail.com',
                'paket_id' => 1, // Pemula
                'jenis_karya' => 1, // Fine Art
                'subkategori' => 1, // Lukis
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