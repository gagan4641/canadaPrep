<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $qualificationsData = [
            [
                'title' => '12th',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Graduation',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Masters',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'PHD',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ]
        ];


        //\App\Models\User::factory(2)->create();

        \App\Models\Country::create([
            'name' => 'India'
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@test.com',
            'phone' => '786786',
            'country_id' => '1',
            'dob' => '1990-01-15'
        ]);

       // \App\Models\Qualification::factory()->create($qualificationsData);
    }
}
