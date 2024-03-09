<?php

namespace Database\Seeders;

use App\Models\Palette;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaletteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pallete = [
            [
                'name' => 'لیمویی /شیری',
                'hex' => '#FFFBB6'
            ],
            [
                'name' => 'زرد',
                'hex' => '#FFF203'
            ],
            [
                'name' => 'خردلی',
                'hex' => '#9C850F'
            ],
            [
                'name' => 'شفقی /صورتی',
                'hex' => '#FF5E95'
            ],
            [
                'name' => 'یاسی',
                'hex' => '#DDACD5'
            ],
            [
                'name' => 'پوست پیازی',
                'hex' => '#B989B1'
            ],
            [
                'name' => 'بنفش',
                'hex' => '#AD0974'
            ],
            [
                'name' => 'طوسی',
                'hex' => '#AEB3B8'
            ],
            [
                'name' => ' تک رنگ ',
                'hex' => '#000'
            ],
            [
                'name' => 'بژ',
                'hex' => '#C3A77C'
            ],
            [
                'name' => 'کرم',
                'hex' => '#F0DEBE'
            ],
            [
                'name' => 'نارنجی',
                'hex' => '#FFA500'
            ],
            [
                'name' => 'خاکستری /طوسی',
                'hex' => '#939598'
            ],
            [
                'name' => 'سربی /طوسی  سرد',
                'hex' => '#959FAD'
            ],
            [
                'name' => 'دودی /طوسی گرم',
                'hex' => '#7C7C7C'
            ],
            [
                'name' => 'هلویی',
                'hex' => '#F5A48C'
            ],
            [
                'name' => 'مسی /حنایی',
                'hex' => '#DC5D20'
            ],
            [
                'name' => 'کاکائویی',
                'hex' => '#7C3005'
            ],
            [
                'name' => 'قهو ه ای',
                'hex' => '#825B41'
            ],
            [
                'name' => 'بادمجانی',
                'hex' => '#BC8F8F'
            ],
            [
                'name' => 'سرخابی',
                'hex' => '#AE1139'
            ],
            [
                'name' => 'قرمز',
                'hex' => '#FF1206'
            ],
            [
                'name' => 'عنابی /زرشکی',
                'hex' => '#830B2C'
            ],
            [
                'name' => 'شرابی',
                'hex' => '#5B152E'
            ],
            [
                'name' => 'ارغوانی',
                'hex' => '#7100A6'
            ],
            [
                'name' => 'آبی',
                'hex' => '#00B2FF'
            ],
            [
                'name' => 'سرمه ای نفتی',
                'hex' => '#092D71'
            ],
            [
                'name' => 'سرمه ای',
                'hex' => '#0428A6'
            ],
            [
                'name' => 'فیروزه‌ای',
                'hex' => '#40D6FF'
            ],
            [
                'name' => 'سبز کبریتی ',
                'hex' => '#00938B'
            ],
            [
                'name' => 'فیروزه ای روشن',
                'hex' => '#69C7BF'
            ],
            [
                'name' => 'سبز ارتشی',
                'hex' => '#003E2D'
            ],
            [
                'name' => 'سبز فسفری ',
                'hex' => '#AFFF05'
            ],
            [
                'name' => 'سبز چمنی ',
                'hex' => '#11BC6A'
            ],
            [
                'name' => 'سبزکله غازی',
                'hex' => '#003E2D'
            ],
            [
                'name' => 'مغزپسته‌ای',
                'hex' => '#8D941E'
            ],
            [
                'name' => 'نخودی',
                'hex' => '#f9f9beab'
            ],
            [
                'name' => 'زیتونی',
                'hex' => '#6C6A19'
            ],

        ];

        Palette::insert($pallete);
    }
}
