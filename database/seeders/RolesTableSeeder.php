<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'role_name' => 'Administrator',
                'description' => 'An administrator has full access to the system and can perform administrative tasks such as user management, system configuration, and other privileged actions.',
            ],
            [
                'role_name' => 'Moderator',
                'description' => 'A moderator has the ability to oversee and manage specific aspects of the system. They may have elevated permissions for utility management.',
            ],
            [
                'role_name' => 'Evaluator',
                'description' => 'An evaluator is responsible for assessing and reviewing instructional materials, submissions, or other items within the system. They may have specific roles related to evaluation and decision-making.',
            ],
            [
                'role_name' => 'Normal User',
                'description' => 'A normal user has standard access to the system with no special privileges.',
            ],
        ];
    
        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
