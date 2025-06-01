<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LandingPageSettings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FeaturedArticlesTableSeeder extends Seeder {
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
        $landingPage->articleRelation()->sync($syncData);
    }
}
