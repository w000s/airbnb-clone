<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Accommodation;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AccommodationReview>
 */
class AccommodationReviewFactory extends Factory
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
            'rating' => fake()->numberBetween(1, 5),
            'review_comment',
            'accommodation_id' => fake()->randomElement($accommodations)
        ];
    }
}
