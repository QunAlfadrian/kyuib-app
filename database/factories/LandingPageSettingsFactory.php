<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LandingPageSettings>
 */
class LandingPageSettingsFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            'display_name' => 'Aniqah Nursabrina',
            'job_title' => 'Fullstack Developer',
            'hero_image_url' => 'https://arkwaifu.cc/api/v1/arts/pic_rogue_3_43/variants/origin/content',
            'about_me_title' => "I Bring Ideas to Life!",
            'about_me_image_url' => 'https://arkwaifu.cc/api/v1/arts/pic_rogue_3_43/variants/origin/content',
            'about_me_body' => $this->faker->paragraph(6),
            'contact_url' => 'https://github.com/'
        ];
    }
}
