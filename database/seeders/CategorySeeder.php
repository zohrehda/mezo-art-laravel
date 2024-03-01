<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::factory()->count(3)->create()->each(function ($category) {
            Category::factory()->create(['type' => 'design', 'parent_id' => $category->id]);
        });

        Category::factory()->count(3)->create(['type' => 'blog']);
    }
}
