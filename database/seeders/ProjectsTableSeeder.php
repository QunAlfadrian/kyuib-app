<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProjectsTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $project = Project::factory()->count(5)->create([
            'owner_id' => 1,
            'category_id' => 1
        ]);
    }
}
