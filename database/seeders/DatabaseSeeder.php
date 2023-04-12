<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Accommodation;
use App\Models\Availability;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::all()->pluck('id')->toArray();
        $accommodations  = Accommodation::all()->pluck('id')->toArray();

        // \App\Models\User::create([
        //     'first_name' => fake()->name(),
        //     'last_name' => fake()->name(),
        //     'email' => fake()->unique()->safeEmail(),
        //     'email_verified_at' => now(),
        //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //     'remember_token' => Str::random(10),
        //     'is_tenant' => true
        // ]);

        \App\Models\Accommodation::create([
            'location' => 'Amsterdam',
            'maximum_of_guests' => 3,
            'bedrooms' => 2,
            'beds' => 4,
            'description' => 'Best leuk huisje opzich',
            'facilities' => 'Met een best leuke omgeving',
            'price' => '100',
            'user_id' => fake()->randomElement($users)
        ]);

        \App\Models\AccommodationReview::create([
            'rating' => fake()->numberBetween(3, 5),
            'review_comment' => 'Best oke',
            'accommodation_id' => fake()->randomElement($accommodations)
        ]);

        Availability::factory()->count(5)->create();

        \App\Models\AccommodationImage::create([
            'src' => fake()->image('storage/app/public', 640, 480, null, false),
            'description' => 'some image',
            'accommodation_id' => fake()->randomElement($accommodations)
        ]);
    }
}
