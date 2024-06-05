<?php

namespace Database\Seeders;

use App\Models\Route;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Route::insert([
            ['name' => 'index'],
            ['name' => 'blog_index'],
            ['name' => 'about'],
        ]);
    }
}
