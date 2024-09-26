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
     
        $offers = [
            ['name' => 'FastSOC Servers', 'installation_fee' => 500, 'monthly_fee' => 100],
            ['name' => 'FastSOC USB', 'installation_fee' => 200, 'monthly_fee' => 50],
            ['name' => 'FastSOC Data', 'installation_fee' => 300, 'monthly_fee' => 75],
        ];

        foreach ($offers as $offer) {
            Offre::create($offer);
        }
    }
}
