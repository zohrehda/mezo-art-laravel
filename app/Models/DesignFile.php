<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class DesignFile extends Model
{
    use HasFactory;
    protected $hidden = [
        'fake_file_path',
        'original_file_path'
    ];

    // protected $appends = ['link'];

    // protected function link(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn($value) => route('files.download', $this),
    //     );
    // }
}
