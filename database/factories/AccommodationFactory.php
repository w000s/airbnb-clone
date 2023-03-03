<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Accommodation>
 */
class AccommodationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = User::all()->pluck('id')->toArray();

        return [
            'location' => fake()->sentence(),
            'maximum_of_guests' => fake()->numberBetween(1, 5),
            'bedrooms' => fake()->numberBetween(1, 15),
            'beds' => fake()->numberBetween(1, 15),
            'description' => fake()->sentence(),
            'facilities' => fake()->sentence(),
            'price' => '100',
            'user_id' => fake()->randomElement($users)
        ];
    }
}
