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
            'owner_id' => 2,
            'category_id' => random_int(1, 4)
        ]);

        $project = Project::factory()->count(5)->create([
            'owner_id' => 3,
            'category_id' => random_int(1, 4)
        ]);
    }
}
