<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoriesTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $category = Category::create([
            'name' => 'Game Development',
            'slug' => Str::slug('Game Development')
        ]);

        $category = Category::create([
            'name' => 'Web Development',
            'slug' => Str::slug('Web Development')
        ]);

        $category = Category::create([
            'name' => 'Backend Development',
            'slug' => Str::slug('Backend Development')
        ]);
    }
}
