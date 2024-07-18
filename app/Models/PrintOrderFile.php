<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrintOrderFile extends Model
{
    use HasFactory, Filterable;
    protected $fillable = [
        'print_order_id',
        'design_file_id',
        'design_width',
        'design_height',
        'design_direction',
        'roll_size',
        'count',
        'pattern_id',
    ];

    public function file()
    {
     return $this->hasOne(DesignFile::class,'id','design_file_id');
    }

}
