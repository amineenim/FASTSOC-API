<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Offre;

class OffreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void 
    {
     
        Offre::insert([
            ['name' => 'FastSOC Servers', 'monthly_fee' => 100.00, 'installation_fee' => 500.00],
            ['name' => 'FastSOC USB', 'monthly_fee' => 50.00, 'installation_fee' => 200.00],
            ['name' => 'FastSOC Data', 'monthly_fee' => 75.00, 'installation_fee' => 300.00],
        ]);
    }
}
