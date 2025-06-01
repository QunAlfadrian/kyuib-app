<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     */
    public function run(): void {
        $this->call(UsersTableSeeder::class);
        $this->call(LandingPageSettingsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ProjectsTableSeeder::class);
        $this->call(ProjectImagesTableSeeder::class);
        $this->call(ArticlesTableSeeder::class);
    }
}
