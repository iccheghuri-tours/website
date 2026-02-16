<?php

namespace Database\Seeders;

use App\Models\PointDeal;
use Illuminate\Database\Seeder;

class PointDealsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        PointDeal::factory()->count(10)->create();

        
    }
}
