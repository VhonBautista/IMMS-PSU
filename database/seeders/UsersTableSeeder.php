<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'lastname' => 'Main',
            'firstname' => 'Admin',
            'middlename' => null,
            'email' => 'main@psu.edu.ph',
            'password' => Hash::make('password'),
            'role_id' => 1,
            'univ_role_id' => 1,
            'campus_id' => 1,
        ]);
    }
}
