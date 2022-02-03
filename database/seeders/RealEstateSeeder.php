<?php

namespace Database\Seeders;

use App\Models\RealEstate;
use Database\Factories\RealEstateFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class RealEstateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RealEstate::factory()->count(20)->create();
    }
}
