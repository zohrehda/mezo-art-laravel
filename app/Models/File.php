<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'fileable_type',
        'fileable_id',
        'path',
        'size'
    ];
    protected $appends = ['link'];

    protected function link(): Attribute
    {
        return Attribute::make(
            get: fn( $value) => url($this->path),
        );
    }
}
