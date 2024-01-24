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
                'title' => 'لیمویی /شیری',
                'hex' => '#FFFBB6'
            ],
            [
                'title' => 'زرد',
                'hex' => '#FFF203'
            ],
            [
                'title' => 'خردلی',
                'hex' => '#9C850F'
            ],
            [
                'title' => 'شفقی /صورتی',
                'hex' => '#FF5E95'
            ],
            [
                'title' => 'یاسی',
                'hex' => '#DDACD5'
            ],
            [
                'title' => 'پوست پیازی',
                'hex' => '#B989B1'
            ],
            [
                'title' => 'بنفش',
                'hex' => '#AD0974'
            ],
            [
                'title' => 'طوسی',
                'hex' => '#AEB3B8'
            ],
            [
                'title' => ' تک رنگ ',
                'hex' => '#000'
            ],
            [
                'title' => 'بژ',
                'hex' => '#C3A77C'
            ],
            [
                'title' => 'کرم',
                'hex' => '#F0DEBE'
            ],
            [
                'title' => 'نارنجی',
                'hex' => '#FFA500'
            ],
            [
                'title' => 'خاکستری /طوسی',
                'hex' => '#939598'
            ],
            [
                'title' => 'سربی /طوسی  سرد',
                'hex' => '#959FAD'
            ],
            [
                'title' => 'دودی /طوسی گرم',
                'hex' => '#7C7C7C'
            ],
            [
                'title' => 'هلویی',
                'hex' => '#F5A48C'
            ],
            [
                'title' => 'مسی /حنایی',
                'hex' => '#DC5D20'
            ],
            [
                'title' => 'کاکائویی',
                'hex' => '#7C3005'
            ],
            [
                'title' => 'قهو ه ای',
                'hex' => '#825B41'
            ],
            [
                'title' => 'بادمجانی',
                'hex' => '#BC8F8F'
            ],
            [
                'title' => 'سرخابی',
                'hex' => '#AE1139'
            ],
            [
                'title' => 'قرمز',
                'hex' => '#FF1206'
            ],
            [
                'title' => 'عنابی /زرشکی',
                'hex' => '#830B2C'
            ],
            [
                'title' => 'شرابی',
                'hex' => '#5B152E'
            ],
            [
                'title' => 'ارغوانی',
                'hex' => '#7100A6'
            ],
            [
                'title' => 'آبی',
                'hex' => '#00B2FF'
            ],
            [
                'title' => 'سرمه ای نفتی',
                'hex' => '#092D71'
            ],
            [
                'title' => 'سرمه ای',
                'hex' => '#0428A6'
            ],
            [
                'title' => 'فیروزه‌ای',
                'hex' => '#40D6FF'
            ],
            [
                'title' => 'سبز کبریتی ',
                'hex' => '#00938B'
            ],
            [
                'title' => 'فیروزه ای روشن',
                'hex' => '#69C7BF'
            ],
            [
                'title' => 'سبز ارتشی',
                'hex' => '#003E2D'
            ],
            [
                'title' => 'سبز فسفری ',
                'hex' => '#AFFF05'
            ],
            [
                'title' => 'سبز چمنی ',
                'hex' => '#11BC6A'
            ],
            [
                'title' => 'سبزکله غازی',
                'hex' => '#003E2D'
            ],
            [
                'title' => 'مغزپسته‌ای',
                'hex' => '#8D941E'
            ],
            [
                'title' => 'نخودی',
                'hex' => '#f9f9beab'
            ],
            [
                'title' => 'زیتونی',
                'hex' => '#6C6A19'
            ],

        ];

        Palette::insert($pallete);
    }
}
