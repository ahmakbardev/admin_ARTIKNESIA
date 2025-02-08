<?php

namespace Database\Seeders;

use App\Models\Exhibition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ExhibitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sourcePath = public_path('pameran-1.jpg');

        // Generate data menggunakan factory
        Exhibition::factory()->count(100)->create()->each(function ($exhibition) use ($sourcePath) {
            // Buat nama unik untuk setiap file gambar
            $uniqueName = Str::uuid() . '.jpg';
            $targetPath = 'exhibitions/' . $uniqueName;

            $path = Storage::disk('public')->putFileAs(
                'exhibitions',
                $sourcePath,
                $uniqueName
            );


            // Perbarui field banner untuk data ini
            $exhibition->update([
                'banner' => $targetPath,
            ]);
        });
    }
}
