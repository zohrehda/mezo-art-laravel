<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrintOrderRoll extends Model
{
    use HasFactory, Filterable;
    protected $fillable = [
       'print_order_id',
       'roll_condition' ,
       'roll_shape',
       'roll_count',
       'roll_width',
       'roll_size',
    ];

    
}
