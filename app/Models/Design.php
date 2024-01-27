<?php

namespace App\Models;

use App\Models\Traits\Fileable;
use App\Models\Traits\Filterable;
use App\Models\Traits\Taggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DesignFile;

class Design extends Model
{
    use HasFactory, Filterable, Taggable, Fileable;

    public function siteFiles()
    {
        return $this->files()->where('section', 'site');
    }

    public function printFiles()
    {
        return $this->hasMany(DesignFile::class, 'design_id');
    }


}
