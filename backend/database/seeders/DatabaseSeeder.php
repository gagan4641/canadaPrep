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
        //\App\Models\User::factory(2)->create();

        \App\Models\Country::create([
            'name' => 'India'
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@test.com',
            'phone' => '786786',
            'country_id' => '1',
        ]);
    }
}
