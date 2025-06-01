<?php

namespace Database\Seeders;

use App\Models\LandingPageSettings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LandingPageSettingsTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        LandingPageSettings::factory()->create();
    }
}
