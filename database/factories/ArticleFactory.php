<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\ArticleTag;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    protected $mode = Article::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence(15);
        $slug = Str::slug($title);

        // Cari user berdasarkan email, jika tidak ditemukan buat user baru
        $user = User::where('email', 'bariqfirjatullah1803@gmail.com')->first()
            ?? User::factory()->create();

        // Cari Article Yang Sudah Di Buat
        $articleTagIds = ArticleTag::pluck('id')->toArray();

        // Membuat descripsi / isi artikel
        $description = $this->faker->paragraphs(10, true);
        return [
            'title' => $title,
            'short_title' => Str::words($title, 3, '...'),
            'slug' => $slug,
            'description' => $description,
            'short_description' => substr($description, 0, 50),
            'meta_title' => $this->faker->sentence(),
            'meta_description' => $this->faker->text(160),
            'meta_robots' => 'index, follow',
            'language' => $this->faker->randomElement(['en', 'id']),
            'image' => '1.png',
            'image_caption' => $this->faker->sentence(),
            'status' => 'publish',
            'tags' => $this->faker->randomElements($articleTagIds, $this->faker->numberBetween(1, 3)),
            'categories' => $this->faker->randomElements(['News', 'Tutorial', 'Review', 'Opinion'], $this->faker->numberBetween(1, 2)),
            'author_id' => $user->id,
            'view_count' => $this->faker->numberBetween(0, 1000),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
