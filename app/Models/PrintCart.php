<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrintCart extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'file_id'
    ];
}
