<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'start_date' => fake()->dateTimeBetween(`-$random weeks`),
            // 'end_date' => fake()->dateTime(),
            // 'status' => 1,
            // 'accommodation_id' => fake()->randomElement($accommodations)
        ];
    }
}
