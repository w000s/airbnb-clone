<?php

namespace Database\Factories;

use App\Models\Accommodation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AccommodationImage>
 */
class AccommodationImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $accommodations = Accommodation::all()->pluck('id')->toArray();

        return [
            'src' => fake()->image('storage/images', 640, 480, null, false),
            'description' => fake()->sentence(),
            'accommodation_id' => fake()->randomElement($accommodations)
        ];
    }
}
