<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PaketSeeder::class,
            AdminUserSeeder::class,
            ArticleTagSeeder::class,
            ArticleSeeder::class,
            ExhibitionSeeder::class
            // Panggil seeder lain jika ada
        ]);
    }
}
