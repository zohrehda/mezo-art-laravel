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
        Route::create([
            'slug' => 'صفحه-ایندکس-مقالات',
            'title' => 'صفحه ایندکس مقالات'
        ]);
    }
}
