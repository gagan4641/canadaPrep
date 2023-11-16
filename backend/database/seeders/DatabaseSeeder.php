<?php

namespace Database\Seeders;

use Cron\HoursField;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use PHPUnit\TextUI\XmlConfiguration\UpdateSchemaLocation;
use SebastianBergmann\CodeCoverage\Driver\Driver;
use SebastianBergmann\Type\SimpleType;

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

        // Insert document groups data
        $documentGroupsData = [
            [
                'title' => 'Research and Initial Preparation',
                'description' => 'Research and Initial Preparation',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Identification and common documents',
                'description' => 'Identification Checklist',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
        ];

        foreach ($documentGroupsData as $row) {
            \App\Models\DocumentGroup::create($row);
        }

        // Insert documents data
        $documentData = [
            [
                'title' => 'Research Programs and Universities',
                'description' => 'Research Programs and Universities',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Check Eligibility and Requirements',
                'description' => 'Check Eligibility and Requirements',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Financial Planning',
                'description' => 'Financial Planning',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Aadhar Card',
                'description' => 'Aadhar Card',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Pan Card',
                'description' => 'Pan Card',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Passport',
                'description' => 'Passport',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
        ];

        foreach ($documentData as $row) {
            \App\Models\Document::create($row);
        }





        // Insert documents data
        $documentData = [
            [
                'document_group_id' => '1',
                'document_id' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'document_group_id' => '1',
                'document_id' => '2',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'document_group_id' => '1',
                'document_id' => '3',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'document_group_id' => '2',
                'document_id' => '4',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'document_group_id' => '2',
                'document_id' => '5',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'document_group_id' => '2',
                'document_id' => '6',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
        ];

        foreach ($documentData as $row) {
            \App\Models\CommonDocument::create($row);
        }
        
    }
}
