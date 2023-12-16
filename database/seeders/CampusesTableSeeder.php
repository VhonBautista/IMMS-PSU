<?php

namespace Database\Seeders;

use App\Models\Campus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CampusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $campuses = [
            ['campus_name' => 'Lingayen', 'location' => 'Alvear E, Poblacion, Lingayen, Pangasinan'],
            ['campus_name' => 'Alaminos', 'location' => 'Bolaney, Alaminos City, Pangasinan'],
            ['campus_name' => 'Asingan', 'location' => 'Domanpot, Asingan, Pangasinan'],
            ['campus_name' => 'Bayambang', 'location' => 'Quezon Blvd, Bayambang, Pangasinan'],
            ['campus_name' => 'Binmaley', 'location' => 'Barangay San Isidro Norte, Binmaley, Pangasinan'],
            ['campus_name' => 'Infanta', 'location' => 'Brgy. Bamban, Infanta, Pangasinan'],
            ['campus_name' => 'San Carlos', 'location' => 'Roxas Boulevard, San Carlos City, Pangasinan'],
            ['campus_name' => 'Sta Maria', 'location' => 'Sitio Cuangao, Namagbagan Sta. Maria, Pangasinan'],
            ['campus_name' => 'Urdaneta', 'location' => 'San Vicente Urdaneta, Pangasinan'],
        ];
    
        foreach ($campuses as $campus) {
            Campus::create($campus);
        }
    }
}
