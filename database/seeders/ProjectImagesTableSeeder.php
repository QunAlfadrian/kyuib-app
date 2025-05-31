<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProjectImagesTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        for ($i = 1; $i <= 5; $i++) {
            $project = Project::find($i);
            $images = ProjectImage::factory()->count(5)->create([
                'project_id' => $project->id
            ]);
        }
    }
}
