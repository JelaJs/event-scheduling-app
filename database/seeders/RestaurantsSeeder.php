<?php

namespace Database\Seeders;

use App\Models\Restaurants;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RestaurantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $faker = Factory::create();
        $restaurantNames = [
            'The Golden Bistro',
            'Spicy Steakhouse',
            'Tasty Diner',
            'Royal Grill',
            'Ocean Café',
            'Sunset Tavern',
            'BBQ Corner',
            'Sushi Lounge',
            'Burger Spot',
            'Pasta House',
        ];

        $usersId = User::where('role', 'restaurant_manager')->limit(10)->get()->pluck('id');

        for($i = 0; $i < 10; $i++) {
        
            Restaurants::create([

                'user_id' => $usersId[$i],
                'name' => $restaurantNames[$i],
                'description' => $faker->text(100),
                'instagram' => 'https://www.instagram.com/radnom_rest/',
                'youtube' => 'https://www.youtube.com/@itmentorstva',
                'phone_number' => $faker->phoneNumber(),
                'address' => $faker->address,
            ]);
        }
    }
}
