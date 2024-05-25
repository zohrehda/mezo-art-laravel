<?php

namespace App\Models\Traits;

use App\Models\File;

trait Fileable
{
    public function files()
    {
        return $this->morphToMany(File::class, 'fileable', 'fileables')->withPivot(['section'])
            ->select('files.*', 'fileables.section as section');
        ;
        //    return $this->morphMany(File::class, 'fileable');
    }
}
