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
        for ($i = 1; $i <= 10; $i++) {
            Article::factory()->count(2)->create([
                'project_id' => $i,
                'author_id' => Project::find($i)->owner()->id()
            ]);
        }
    }
}
