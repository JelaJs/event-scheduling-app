<?php

namespace Database\Seeders;

use App\Models\Bands;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $faker = Factory::create();
        $bandNames = [
            "Echo Drift",
            "Neon Vortex",
            "The Skyliners",
            "Midnight Pulse",
            "Shadow Anthem",
            "Velvet Riot",
            "Electric Mirage",
            "Lunar Echoes",
            "Stormchase",
            "Gravity Noise"
        ];
        

        $usersId = User::where('role', 'band_manager')->limit(10)->get()->pluck('id');

        for($i = 0; $i < 10; $i++) {
        
            Bands::create([

                'user_id' => $usersId[$i],
                'name' => $bandNames[$i],
                'description' => $faker->text(100),
                'instagram' => 'https://www.instagram.com/radnom_rest/',
                'youtube' => 'https://www.youtube.com/@itmentorstva',
                'phone_number' => $faker->phoneNumber()
            ]);
        }
    }
}
