<?php

namespace Database\Seeders;

use App\Models\Design;
use App\Models\DesignFile;
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
                $path = 'designs/' . $design->id;
                Storage::makeDirectory($path.'/site');
                Storage::makeDirectory($path.'/fake');
                Storage::makeDirectory($path.'/original');

                for ($i = 0; $i < 2; $i++) {
                    File::factory()->create([
                        'fileable_type' => Design::class,
                        'fileable_id' => $design->id,
                        'path' => str_replace('storage/', '', fake()->image('storage/app/' . $path . '/site')),
                        // 'path' => 'app/' . $path . '/' . fake()->image('storage/app/' . $path, 640, 480, null, true),
                        'section' => 'site',
                    ]);

                    DesignFile::factory()->create([
                        'design_id'=>$design->id ,
                        'original_file_path' => str_replace('storage/', '', fake()->image('storage/app/' . $path . '/original')),
                        'fake_file_path' => str_replace('storage/', '', fake()->image('storage/app/' . $path . '/fake')),
                    ]);
                }
            })
        ;
    }
}