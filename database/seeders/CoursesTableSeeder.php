<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = [
            ['course_name' => 'Bachelor of Science in Information Technology', 'campus_id' => 9],
            ['course_name' => 'Bachelor of Science in Mathematics', 'campus_id' => 9],
            ['course_name' => 'Bachelor of Secondary Education major in Filipino', 'campus_id' => 9],
            ['course_name' => 'Bachelor of Secondary Education major in Science', 'campus_id' => 9],
            ['course_name' => 'Bachelor of Arts in English Language', 'campus_id' => 9],
            ['course_name' => 'Bachelor of Early Childhood Education', 'campus_id' => 9],
            ['course_name' => 'Bachelor of Science in Architecture', 'campus_id' => 9],
            ['course_name' => 'Bachelor of Science in Civil Engineering', 'campus_id' => 9],
            ['course_name' => 'Bachelor of Science in Computer Engineering', 'campus_id' => 9],
            ['course_name' => 'Bachelor of Science in Mechanical Engineering', 'campus_id' => 9],
            ['course_name' => 'Bachelor of Science in Electrical Engineering', 'campus_id' => 9]
        ];
    
        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}
