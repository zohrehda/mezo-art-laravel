<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provinces = Storage::get('provinces.json');
        $provinces = json_decode($provinces, true);
        array_walk($provinces, function (&$province) {
            $province= ['name'=>$province['name']
                   
            ] ;
        });
        
        Province::insert($provinces);
    }
}
