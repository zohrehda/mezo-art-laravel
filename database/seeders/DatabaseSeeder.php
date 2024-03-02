<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
    //    dd(Hash::make('password')) ;
        User::factory()->create();

        $this->call([
            ProvinceSeeder::class,
            CitySeeder::class,
            CategorySeeder::class,
            TagSeeder::class,
            DesignSeeder::class,
            PaletteSeeder::class,
            TicketSeeder::class,
            BlogSeeder::class
        ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
