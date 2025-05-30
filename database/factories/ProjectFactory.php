<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory {
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
            'hero_image_url' => 'https://arkwaifu.cc/api/v1/arts/pic_rogue_1_16/variants/origin/content',
            'description' => $this->faker->paragraph(),
            'start_date' => $this->faker->dateTime('now'),
            'owner_id' => $attribute['owner_id'] ?? User::factory(),
            'category_id' => $attribute['category_id'] ?? Category::factory()
        ];
    }
}
