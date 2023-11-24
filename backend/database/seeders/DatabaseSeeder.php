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
            [
                'title' => 'Documents checklist related to your children',
                'description' => 'Documents checklist related to your children',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Documents checklist related to past refusal/refusals',
                'description' => 'Documents checklist related to past refusal/refusals',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Documents checklist related to the Court Case/Crime Record',
                'description' => 'Documents checklist related to the Court Case/Crime Record',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Documents checklist related to Gap in profile',
                'description' => 'Documents checklist related to Gap in profile',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'You need to attempt atlest one of the below given language tests with mentioned required results',
                'description' => 'You need to attempt atlest one of the below given language tests with mentioned required results',
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
            [
                'title' => 'Children Birth Certificate',
                'description' => 'Children Birth Certificate',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Children Passport',
                'description' => 'Children Passport',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Children Aadhar Card',
                'description' => 'Children Aadhar Card',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Application number/GC Key if possible',
                'description' => 'Application number/GC Key if possible',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Purpose of visit',
                'description' => 'Purpose of visit',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Explanation Letter/Caips notes for refusal',
                'description' => 'Explanation Letter/Caips notes for refusal',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Improved Financial/Assets Documentation',
                'description' => 'Improved Financial/Assets Documentation',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Proof of Ties to Home Country',
                'description' => 'Proof of Ties to Home Country',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Police Clearance Certificate',
                'description' => 'Police Clearance Certificate',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'A detailed and honest Explanation Letter explaining the circumstances',
                'description' => 'A detailed and honest Explanation Letter explaining the circumstances',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Character References from credible sources (Such as employers, community leaders, teachers, etc)',
                'description' => 'Character References from credible sources (Such as employers, community leaders, teachers, etc)',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Any additional supporting evidences',
                'description' => 'Any additional supporting evidences',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'It is suggested to contact our official immigration lawyers/advisors for better suggestion',
                'description' => 'It is suggested to contact our official immigration lawyers/advisors for better suggestion',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'A detailed Explanation Letter explaining the reason(s) for the gap',
                'description' => 'A detailed Explanation Letter explaining the reason(s) for the gap',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Relevant Certificates/Documents supports the explanation provided in the letter',
                'description' => 'Relevant Certificates/Documents supports the explanation provided in the letter',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Proof of Activities during the Gap (Such as Freelancing, Volunteer Work, Internships, Courses, etc.)',
                'description' => 'Proof of Activities during the Gap (Such as Freelancing, Volunteer Work, Internships, Courses, etc.)',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'IELTS (International English Language Testing System): Minimum Requirement: Typically, universities require an overall band score ranging from 6.0 to 7.5 for undergraduate programs and 6.5 to 8.0 for postgraduate programs, depending on the institution and course.',
                'description' => 'IELTS (International English Language Testing System): Minimum Requirement: Typically, universities require an overall band score ranging from 6.0 to 7.5 for undergraduate programs and 6.5 to 8.0 for postgraduate programs, depending on the institution and course.',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'TOEFL (Test of English as a Foreign Language): Minimum Requirement: Scores range from 60 to 100 for undergraduate programs and 80 to 110 for postgraduate programs, depending on the institution and course.',
                'description' => 'TOEFL (Test of English as a Foreign Language): Minimum Requirement: Scores range from 60 to 100 for undergraduate programs and 80 to 110 for postgraduate programs, depending on the institution and course.',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'PTE Academic (Pearson Test of English Academic): Minimum Requirement: Scores range from 50 to 70 for undergraduate programs and 58 to 79 for postgraduate programs, depending on the institution and course.',
                'description' => 'PTE Academic (Pearson Test of English Academic): Minimum Requirement: Scores range from 50 to 70 for undergraduate programs and 58 to 79 for postgraduate programs, depending on the institution and course.',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Cambridge English Qualifications (such as C1 Advanced or C2 Proficiency): Minimum Requirement: Institutions often request a C1 or C2 level, which equates to scores between 160 to 210 for C1 Advanced and 180 to 230 for C2 Proficiency.',
                'description' => 'Cambridge English Qualifications (such as C1 Advanced or C2 Proficiency): Minimum Requirement: Institutions often request a C1 or C2 level, which equates to scores between 160 to 210 for C1 Advanced and 180 to 230 for C2 Proficiency.',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Aadhar Card of the family members and financial supporter',
                'description' => 'Aadhar Card of the family members and financial supporter',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Pan Card of the family members and financial supporter',
                'description' => 'Pan Card of the family members and financial supporter',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Passport of the family members and financial supporter',
                'description' => 'Passport of the family members and financial supporter',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Tax returns of last 2 years',
                'description' => 'Tax returns of last 2 years',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Tax returns of last 2 years of parents or Guardians or Supporter',
                'description' => 'Tax returns of last 2 years of parents or Guardians or Supporter',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Property evaluation report from chartered accountant',
                'description' => 'Property evaluation report from chartered accountant',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Gold evaluation report from chartered accountant',
                'description' => 'Gold evaluation report from chartered accountant',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'title' => 'Cash and other assets like vehicles, investments and business turnover evaluation report from chartered accountant',
                'description' => 'Cash and other assets like vehicles, investments and business turnover evaluation report from chartered accountant',
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
            [
                'document_group_id' => '2',
                'document_id' => '50',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'document_group_id' => '2',
                'document_id' => '51',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'document_group_id' => '2',
                'document_id' => '52',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'document_group_id' => '2',
                'document_id' => '53',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'document_group_id' => '2',
                'document_id' => '54',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'document_group_id' => '2',
                'document_id' => '55',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'document_group_id' => '2',
                'document_id' => '56',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'document_group_id' => '2',
                'document_id' => '57',
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

        // Insert work experience documents data
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

        // Insert children documents data
        $childrenDocumentData = [
            [
                'document_id' => '30',
                'document_group_id' => '6',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'document_id' => '31',
                'document_group_id' => '6',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'document_id' => '32',
                'document_group_id' => '6',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
        ];

        foreach ($childrenDocumentData as $row) {
            \App\Models\ChildrenDocument::create($row);
        }

        // Insert refusal documents data
        $refusalDocumentData = [
            [
                'document_id' => '33',
                'document_group_id' => '7',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'document_id' => '34',
                'document_group_id' => '7',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'document_id' => '35',
                'document_group_id' => '7',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'document_id' => '36',
                'document_group_id' => '7',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'document_id' => '37',
                'document_group_id' => '7',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
        ];

        foreach ($refusalDocumentData as $row) {
            \App\Models\RefusalDocument::create($row);
        }

        // Insert crime record documents data
        $crimeRecordDocumentData = [
            [
                'document_id' => '38',
                'document_group_id' => '8',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'document_id' => '39',
                'document_group_id' => '8',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'document_id' => '40',
                'document_group_id' => '8',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'document_id' => '41',
                'document_group_id' => '8',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'document_id' => '42',
                'document_group_id' => '8',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
        ];

        foreach ($crimeRecordDocumentData as $row) {
            \App\Models\CrimeRecordDocument::create($row);
        }

        // Insert profile gap documents data
        $profileGapDocumentData = [
            [
                'document_id' => '43',
                'document_group_id' => '9',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'document_id' => '44',
                'document_group_id' => '9',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'document_id' => '45',
                'document_group_id' => '9',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
        ];

        foreach ($profileGapDocumentData as $row) {
            \App\Models\ProfileGapDocument::create($row);
        }

        // Insert profile gap documents data
        $languageTestDocumentData = [
            [
                'document_id' => '46',
                'document_group_id' => '10',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'document_id' => '47',
                'document_group_id' => '10',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'document_id' => '48',
                'document_group_id' => '10',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
            [
                'document_id' => '49',
                'document_group_id' => '10',
                'status' => '1',
                'created_at' => '2023-11-06 01:14:14',
                'updated_at' => '2023-11-06 01:14:14'
            ],
        ];

        foreach ($languageTestDocumentData as $row) {
            \App\Models\LanguageTestDocument::create($row);
        }

    }
}
