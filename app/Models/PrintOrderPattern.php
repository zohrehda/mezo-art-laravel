<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrintOrderPattern extends Model
{
    use HasFactory, Filterable;
    protected $fillable = [
       'print_order_id',
       'name' ,
       'width',
       'height',
       'count',
    ];

    
}
