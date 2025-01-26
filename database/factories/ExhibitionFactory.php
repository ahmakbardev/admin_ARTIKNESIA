<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exhibition>
 */
class ExhibitionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->sentence(3);
        $startDate = $this->faker->dateTimeBetween('+1 week', '+2 weeks');
        $endDate = clone $startDate;
        $endDate->modify('+' . rand(1, 14) . ' days');

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->paragraphs(3, true),
            'category' => $this->faker->randomElement(['lukisan', 'fotografi', 'instalasi']),
            'city' => $this->faker->randomElement(['malang', 'batu']),
            'address' => $this->faker->address(),
            'type' => $this->faker->randomElement(['onsite', 'virtual']),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'price' => $this->faker->randomElement([0, 25000, 50000, 100000, 150000]),
            'banner' => 'exhibitions/default-banner.jpg',
            'organizer' => $this->faker->company(),
            'status' => $this->faker->randomElement(['draft', 'upcoming', 'ongoing', 'completed']),
            'link' => $this->faker->url(),
        ];
    }
}
