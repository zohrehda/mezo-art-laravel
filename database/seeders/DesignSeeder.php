<?php

namespace Database\Seeders;

use App\Models\Design;
use App\Models\File;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DesignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Design::factory()->count(2)->hasTags(2)->hasFiles(1, ['section' => 'ff'])->create(['category_id' => 1]);

        Design::factory()->count(2)

            ->create()

            ->each(function (Design $design) {

                $files = [
                    'main' => 'designs/' . $design->id . '/main',
                    'fake' => 'designs/' . $design->id . '/fake',
                    'site' => 'designs/' . $design->id . '/site'
                ];

                array_walk($files, function ($file, $key) use ($design) {
                    // mixed $dir = null,
                    // mixed $width = 640,
                    // mixed $height = 480,
                    // mixed $category = null,
                    // mixed $fullPath = true,
                    // mixed $randomize = true,
                    // mixed $word = null,
                    // mixed $gray = false,
                    // string|null $format = 'png'
                    Storage::makeDirectory($file);
                    File::factory()->count(6)->create([
                        'fileable_type' => Design::class,
                        'fileable_id' => $design->id,
                        'path' => 'app/'.$file .'/'. fake()->image('storage/app/' . $file,640,480,null,false),
                        'section' => $key
                    ]);
                });

            })
        ;
    }
}