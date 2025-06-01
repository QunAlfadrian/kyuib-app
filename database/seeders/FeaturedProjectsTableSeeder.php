<?php

namespace Database\Seeders;

use App\Models\LandingPageSettings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeaturedProjectsTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $landingPage = LandingPageSettings::first();

        $syncData = [];
        for ($i = 1; $i <= 5; $i++) {
            $syncData[$i] = [
                'position' => $i
            ];
        }
        $landingPage->projectRelation()->sync($syncData);
    }
}
