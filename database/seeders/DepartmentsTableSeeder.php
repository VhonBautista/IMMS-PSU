<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            ['department_name' => 'Information Technology Department', 'campus_id' => 9],
            ['department_name' => 'Secondary Education Department', 'campus_id' => 9],
            ['department_name' => 'Arts in English Language Department', 'campus_id' => 9],
            ['department_name' => 'Early Childhood Education Department', 'campus_id' => 9],
            ['department_name' => 'Architecture Department', 'campus_id' => 9],
            ['department_name' => 'Civil Engineering Department', 'campus_id' => 9],
            ['department_name' => 'Computer Engineering Department', 'campus_id' => 9],
            ['department_name' => 'Mechanical Engineering Department', 'campus_id' => 9],
            ['department_name' => 'Electrical Engineering Department', 'campus_id' => 9],
            ['department_name' => 'Mathematics Department', 'campus_id' => 9]
        ];
    
        foreach ($departments as $department) {
            Department::create($department);
        }
    }
}
