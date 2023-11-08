<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Truncate (empty) all tables
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        $tables = DB::select('SHOW TABLES');
        foreach ($tables as $table) {
            $table = get_object_vars($table);
            $tableName = array_values($table)[0];
            DB::table($tableName)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Insert country data
        \App\Models\Country::create([
            'name' => 'India'
        ]);

        // Insert category data
        \App\Models\Category::create([
            'title' => 'Study',
            'status' => '1',
        ]);

        // Insert user data
        \App\Models\User::factory()->create([
            'name' => 'Gagan Vaid',
            'email' => 'gagan@test.com',
            'phone' => '786786',
            'country_id' => '1',
            'dob' => '1992-11-18'
        ]);

        // Insert qualifications data
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

        foreach ($qualificationsData as $row) {
            \App\Models\Qualification::create($row);
        }

        // Insert marital status data
        $maritalStatusData = [
            [
                'title' => 'Single',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Married',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Divorced',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Widow',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ]
        ];

        foreach ($maritalStatusData as $row) {
            \App\Models\MaritalStatus::create($row);
        }

    }
}
