<?php

namespace App\Models\Traits;

use App\Models\File;

trait Fileable
{
    public function files()
    {
        return $this->morphMany(File::class,'fileable');
        
    }
}
