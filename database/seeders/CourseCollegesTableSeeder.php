<?php

namespace Database\Seeders;

use App\Models\CourseCollege;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseCollegesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $course_colleges = [
            ['college_id' => 1, 'course_id' => 1],
            ['college_id' => 1, 'course_id' => 2],
            ['college_id' => 2, 'course_id' => 3],
            ['college_id' => 2, 'course_id' => 4],
            ['college_id' => 2, 'course_id' => 5],
            ['college_id' => 2, 'course_id' => 6],
            ['college_id' => 3, 'course_id' => 7],
            ['college_id' => 3, 'course_id' => 8],
            ['college_id' => 3, 'course_id' => 9],
            ['college_id' => 3, 'course_id' => 10],
            ['college_id' => 3, 'course_id' => 11],
        ];
    
        foreach ($course_colleges as $course_college) {
            CourseCollege::create($course_college);
        }
    }
}
