<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $seeders = [
            CampusesTableSeeder::class,
            CoursesTableSeeder::class,
            CollegesTableSeeder::class,
            // CourseCollegesTableSeeder::class,
            DepartmentsTableSeeder::class,
            RolesTableSeeder::class,
            UniversityRolesTableSeeder::class,
            UsersTableSeeder::class,
        ];

        foreach ($seeders as $seeder) {
            $model = $this->getModelFromSeeder($seeder);

            if ($model::count() === 0) {
                $this->call($seeder);
            }
        }
    }

    private function getModelFromSeeder($seeder)
    {
        $tableName = str_replace('TableSeeder', '', class_basename($seeder));
        $modelClass = Str::studly(Str::singular($tableName));
        $modelClass = 'App\Models\\' . $modelClass;

        return app($modelClass);
    }
}
