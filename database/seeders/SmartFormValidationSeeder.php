<?php

namespace Database\Seeders;

use App\Models\SmartFormValidation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SmartFormValidationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SmartFormValidation::factory()->count(50)->create();
    }
}
