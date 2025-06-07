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

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'hero_image_url' => 'https://arkwaifu.cc/api/v1/arts/pic_rogue_2_6/variants/origin/content',
            'body' => $this->faker->paragraph(10),
            'project_id' => $attribute['project_id'] ?? 1,
            'author_id' => $attribute['author_id'] ?? 1
        ];
    }
}
