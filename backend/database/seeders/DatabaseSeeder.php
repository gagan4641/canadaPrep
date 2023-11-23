<?php

namespace Database\Seeders;

use Cron\HoursField;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use PHPUnit\TextUI\XmlConfiguration\UpdateSchemaLocation;
use SebastianBergmann\CodeCoverage\Driver\Driver;
use SebastianBergmann\Type\SimpleType;

use function Ramsey\Uuid\v1;

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

        // Insert document groups data
        $documentGroupsData = [
            [
                'title' => 'Research and Initial Preparation checklist',
                'description' => 'Research and Initial Preparation checklist',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Identification and common documents checklist',
                'description' => 'Identification and common documents checklist',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Qualification documents checklist',
                'description' => 'Qualification documents checklist',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Work experience documents checklist',
                'description' => 'Work experience documents checklist',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Marital status documents checklist',
                'description' => 'Marital status documents checklist',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
        ];

        foreach ($documentGroupsData as $row) {
            \App\Models\DocumentGroup::create($row);
        }

        // Insert qualifications data
        $qualificationsData = [
            [
                'title' => '12th',
                'status' => '1',
                'document_group_id' => '3',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Diploma',
                'status' => '1',
                'document_group_id' => '3',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Graduation',
                'status' => '1',
                'document_group_id' => '3',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Masters',
                'status' => '1',
                'document_group_id' => '3',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'PHD',
                'status' => '1',
                'document_group_id' => '3',
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
                'document_group_id' => '5',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Married',
                'status' => '1',
                'document_group_id' => '5',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Divorced',
                'status' => '1',
                'document_group_id' => '5',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Widow',
                'status' => '1',
                'document_group_id' => '5',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ]
        ];

        foreach ($maritalStatusData as $row) {
            \App\Models\MaritalStatus::create($row);
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
            [
                'title' => '12th Mark Sheet',
                'description' => '12th Mark Sheet',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => '12th Passing Certificate',
                'description' => '12th Passing Certificate',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Diploma Certificate',
                'description' => 'Diploma Certificate',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Degree Certificate',
                'description' => 'Degree Certificate',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Transcripts',
                'description' => 'Diploma Transcripts',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Course completion certificate',
                'description' => 'Course completion certificate',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Backlog certificate',
                'description' => 'Backlog certificate',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Research Thesis/Dissertation',
                'description' => 'Research Thesis/Dissertation',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Recommendation Letters',
                'description' => 'Recommendation Letters',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Publications (if any)',
                'description' => 'Publications (if any)',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Certificate translation if not in English or French',
                'description' => 'Certificate translation if not in English or French',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Offer Letters',
                'description' => 'Offer Letters',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Contracts/Agreements',
                'description' => 'Contracts/Agreements',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Experience Letters',
                'description' => 'Experience Letters',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Salary Slips/Pay Stubs',
                'description' => 'Salary Slips/Pay Stubs',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Marriage Certificate',
                'description' => 'Marriage Certificate',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Divorce Certificate',
                'description' => 'Divorce Certificate',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Death Certificate of your spouse',
                'description' => 'Death Certificate of your spouse',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Spouse Passport',
                'description' => 'Spouse Passport',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Spouse Pan Card',
                'description' => 'Spouse Pan Card',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Spouse Aadhar Card',
                'description' => 'Spouse Aadhar Card',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Spouse Passport (if Possible)',
                'description' => 'Spouse Passport (if Possible)',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Spouse Aadhar Card (if Possible)',
                'description' => 'Spouse Aadhar Card (if Possible)',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
        ];

        foreach ($documentData as $row) {
            \App\Models\Document::create($row);
        }

        // Insert common documents data
        $commonDocumentData = [
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

        foreach ($commonDocumentData as $row) {
            \App\Models\CommonDocument::create($row);
        }

        // Insert document qualification data
        $documentQualificationData = [
            [
                'qualification_id' => '1',
                'document_id' => '7',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'qualification_id' => '1',
                'document_id' => '8',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'qualification_id' => '1',
                'document_id' => '17',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'qualification_id' => '2',
                'document_id' => '9',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'qualification_id' => '2',
                'document_id' => '11',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'qualification_id' => '2',
                'document_id' => '12',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'qualification_id' => '2',
                'document_id' => '13',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'qualification_id' => '2',
                'document_id' => '17',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'qualification_id' => '3',
                'document_id' => '10',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'qualification_id' => '3',
                'document_id' => '11',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'qualification_id' => '3',
                'document_id' => '12',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'qualification_id' => '3',
                'document_id' => '13',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'qualification_id' => '3',
                'document_id' => '17',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'qualification_id' => '4',
                'document_id' => '10',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'qualification_id' => '4',
                'document_id' => '11',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'qualification_id' => '4',
                'document_id' => '12',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'qualification_id' => '4',
                'document_id' => '13',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'qualification_id' => '4',
                'document_id' => '14',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'qualification_id' => '4',
                'document_id' => '17',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'qualification_id' => '5',
                'document_id' => '10',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'qualification_id' => '5',
                'document_id' => '11',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'qualification_id' => '5',
                'document_id' => '12',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'qualification_id' => '5',
                'document_id' => '13',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'qualification_id' => '5',
                'document_id' => '14',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'qualification_id' => '5',
                'document_id' => '15',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'qualification_id' => '5',
                'document_id' => '16',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'qualification_id' => '5',
                'document_id' => '17',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
        ];

        foreach ($documentQualificationData as $row) {
            \App\Models\QualificationDocument::create($row);
        }

        // Insert common documents data
        $workExperienceDocumentData = [
            [
                'document_id' => '18',
                'document_group_id' => '4',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'document_id' => '19',
                'document_group_id' => '4',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'document_id' => '20',
                'document_group_id' => '4',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'document_id' => '21',
                'document_group_id' => '4',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'document_id' => '17',
                'document_group_id' => '4',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
        ];

        foreach ($workExperienceDocumentData as $row) {
            \App\Models\WorkExperienceDocument::create($row);
        }
        
        // Insert marital status documents data
        $maritalStatusDocumentData = [
            [
                'marital_status_id' => '2',
                'document_id' => '22',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'marital_status_id' => '2',
                'document_id' => '25',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'marital_status_id' => '2',
                'document_id' => '26',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'marital_status_id' => '2',
                'document_id' => '27',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'marital_status_id' => '3',
                'document_id' => '23',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'marital_status_id' => '3',
                'document_id' => '28',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'marital_status_id' => '3',
                'document_id' => '29',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'marital_status_id' => '4',
                'document_id' => '24',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'marital_status_id' => '4',
                'document_id' => '28',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'marital_status_id' => '4',
                'document_id' => '29',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
        ];

        foreach ($maritalStatusDocumentData as $row) {
            \App\Models\MaritalStatusDocument::create($row);
        }

    }
}
