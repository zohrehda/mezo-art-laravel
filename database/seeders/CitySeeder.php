<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;


class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = Storage::get('cities.json');
        $cities = json_decode($cities, true);
        array_walk($cities, function (&$city) {
            $city = [
                'name' => $city['name'],
                'province_id' => $city['province_id']
            ];
        });

        City::insert($cities);
    }
}
