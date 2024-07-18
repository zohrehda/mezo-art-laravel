<?php

namespace Database\Seeders;

use App\Models\FabricMaterial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class FabricMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $materials = [
            'ریون',
            'مازراتی',
            'بوگاتی',
            'کرپ حریر',
            'فیلامنت',
            'فیلامنت سوزنی',
            'فیلامنت طرح دار',
            'مخمل',
            'ساتن',
            'لینن',
            'لاکرا',
            'کنف',
            'دورس دو نغ',
            'دوری سه نخ',
            'میکرو ساده',
            'میکرو طرح دار',
            'اسپان',
        ];

        FabricMaterial::insert(array_map(function ($m) {
            return [
                'name' => $m,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }, $materials));
    }
}
