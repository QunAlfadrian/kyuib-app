<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProjectImage>
 */
class ProjectImageFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        $name = $this->faker->sentence(3);
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'alternative_text' => 'image',
            'filename' => Str::slug($name) . '.webp',
            'url' => 'https://arkwaifu.cc/api/v1/arts/pic_rogue_3_14/variants/origin/content',
            'project_id' => $attribute['project_id'] ?? 1
        ];
    }
}
