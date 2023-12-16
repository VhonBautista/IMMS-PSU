<?php

namespace Database\Seeders;

use App\Models\UniversityRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UniversityRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $university_roles = [
            [
                'university_role' => 'Master of Information Systems',
                'description' => 'Holder of the Master of Information Systems degree.'
            ],
            [
                'university_role' => 'President',
                'description' => 'The President of the university, responsible for overall leadership and decision-making.'
            ],
            [
                'university_role' => 'Vice President',
                'description' => 'The Vice President of the university, supporting the President and overseeing specific areas of responsibility.'
            ],
            [
                'university_role' => 'College Dean',
                'description' => 'The Dean of a college, responsible for academic and administrative leadership within the college.'
            ],
            [
                'university_role' => 'Chairman',
                'description' => 'The Chairman of a department, providing leadership and coordination within a specific academic department.'
            ],
            [
                'university_role' => 'Senior Faculty',
                'description' => 'A senior faculty member with extensive experience and expertise in their field.'
            ],
            [
                'university_role' => 'Faculty',
                'description' => 'A faculty member involved in teaching and research activities.'
            ],
            [
                'university_role' => 'Campus Executive Director',
                'description' => 'The executive leader of a university campus, responsible for campus-wide administration and coordination.'
            ],
            [
                'university_role' => 'Center of Foreign Languages',
                'description' => 'Responsible for overseeing activities related to foreign languages within the university.'
            ],
            [
                'university_role' => 'Curriculum & Instruction',
                'description' => 'Responsible for curriculum development and instructional strategies within the university.'
            ],
        ];
    
        foreach ($university_roles as $university_role) {
            UniversityRole::create($university_role);
        }
    }
}
