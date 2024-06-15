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
        User::updateOrCreate([
            'mobile' => '09123908699',
        ], [
            'first_name' => 'محسن',
            'last_name' => 'مشفق',
            'mobile' => '09203908699',
            'role' => 'admin',
            'email' => '',
            'password' => Hash::make('password'),

        ]);

        User::updateOrCreate([
            'mobile' => '09386376960',

        ], [
            'first_name' => 'زهره',
            'last_name' => 'ٔدائیان',
            'email' => 'daeian.zohreh@gmail.com',
            'mobile' => '09386376960',
            'role' => 'admin',
            'password' =>  Hash::make('password'),

        ]);



        $this->call([
            ProvinceSeeder::class,
            CitySeeder::class,
                //    CategorySeeder::class,
                //      TagSeeder::class,
            PaletteSeeder::class,
            RouteSeeder::class
            //  TicketSeeder::class,
            //  BlogSeeder::class ,
            //       DesignSeeder::class,
        ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
