<?php

namespace Database\Seeders;

use App\Models\ArticleTag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            'Art', 'Paint', 'Therapy', 'Film', 'Invest', 
            'Educational', 'Inspirational', 'Promotional'
        ];

        foreach ($tags as $tag) {
            ArticleTag::firstOrCreate(['name' => $tag]); // Hindari duplikasi
        }
    }
}
