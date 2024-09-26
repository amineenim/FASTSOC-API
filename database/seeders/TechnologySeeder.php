<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Technology;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void 
    {
        Technology::insert([
            ['name' => 'SecureServe', 'offer_id' => 1],
            ['name' => 'USBProtector', 'offer_id' => 2],
            ['name' => 'FranceProtection', 'offer_id' => 1],
            ['name' => 'MyDatas', 'offer_id' => 3],
            ['name' => 'ServerStrike', 'offer_id' => 1],
        ]);
    }
}
