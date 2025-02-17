<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = ['customer', 'band_manager', 'restaurant_manager'];

        $faker = Factory::create();
        
        for($i=0; $i<50; $i++) {

            User::create([

                'name' => $faker->name,
                'email' => $faker->email,
                'password' => Hash::make('1234567'),
                'role' => $role[rand(0,2)],
            ]);
        }
    }
}
