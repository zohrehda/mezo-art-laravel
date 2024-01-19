<?php

namespace App\Models\Traits;

use App\Models\File;

trait Fileable
{
    public function initializeFileableTrait()
    {
        array_push($this->relationships, 'files');
    }

    public function files()
    {
        return $this->morphMany(File::class);
    }
}
