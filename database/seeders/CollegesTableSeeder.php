<?php

namespace Database\Seeders;

use App\Models\College;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CollegesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colleges = [
            [
                'college_name' => 'College of Computing', 
                'description' => '
                The College of Computing is a dynamic hub for computer science and technology education, offering a comprehensive curriculum and hands-on projects that prepare students to thrive in the fast-paced world of technology.', 
                'campus_id' => 9],
            [
                'college_name' => 'College of Arts and Education', 
                'description' => 'The College of Arts and Education is a vibrant academic institution fostering creativity and excellence in the fine arts, humanities, social sciences, and education. Our diverse curriculum, supportive faculty, and emphasis on experiential learning equip graduates for impactful roles in the arts, education, and beyond.', 
                'campus_id' => 9],
            [
                'college_name' => 'College of Engineering and Architecture', 
                'description' => '
                The College of Engineering and Architecture is a premier institution focused on excellence in engineering and architectural education. Our hands-on approach, guided by experienced faculty, equips students with the skills and knowledge for impactful careers in these dynamic fields. Join us at the forefront of innovation and design within the vibrant community of the College of Engineering and Architecture.', 
                'campus_id' => 9],
        ];
    
        foreach ($colleges as $college) {
            College::create($college);
        }
    }
}
