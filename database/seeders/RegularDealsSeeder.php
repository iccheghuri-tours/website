<?php

namespace Database\Seeders;

use App\Models\RegularDeal;
use Illuminate\Database\Seeder;

class RegularDealsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        RegularDeal::factory()->count(10)->create();

    }
}
