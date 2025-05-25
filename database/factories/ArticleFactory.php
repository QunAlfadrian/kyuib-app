<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        $title = $this->faker->sentence();
        $project = $attribute['project_id'] ?? Project::factory()->create();
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'body' => $this->faker->paragraph(),
            'project_id' => $project,
            'author_id' => $attribute['author_id'] ?? $project->owner()->id()
        ];
    }
}
