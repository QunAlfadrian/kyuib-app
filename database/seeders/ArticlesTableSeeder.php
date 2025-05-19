<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ArticlesTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        Article::factory()->count(10)->create(['project_id' => 1]);
    }
}
