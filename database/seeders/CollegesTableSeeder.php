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
            ['college_name' => 'College of Computing', 'campus_id' => 9],
            ['college_name' => 'College of Arts and Education', 'campus_id' => 9],
            ['college_name' => 'College of Engineering and Architecture', 'campus_id' => 9],
        ];
    
        foreach ($colleges as $college) {
            College::create($college);
        }
    }
}
