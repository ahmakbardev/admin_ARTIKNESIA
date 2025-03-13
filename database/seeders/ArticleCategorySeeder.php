<?php

namespace Database\Seeders;

use App\Models\ArticleCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Lukisan', 'Patung', 'Fotografi', 'Seni Digital', 
            'Seni Instalasi', 'Seni Pertunjukan', 'Seni Grafis', 'Keramik'
        ];
        foreach ($categories as $categorie) {
            ArticleCategory::firstOrCreate(['name' => $categorie]);
        }
    }
}
