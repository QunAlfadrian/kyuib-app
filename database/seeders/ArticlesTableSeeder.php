<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ArticlesTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $article = Article::factory()->count(7)->create([
            'project_id' => 1,
            'author_id' => Project::find(1)->owner()->id()
        ]);
        $article = Article::factory()->count(3)->create([
            'project_id' => 2,
            'author_id' => Project::find(2)->owner()->id()
        ]);
    }
}
