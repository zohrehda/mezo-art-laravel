<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMeta extends Model
{
    use HasFactory;
    protected $fillable = [
        'brand_name',
        'guild',
        'province_id',
        'city_id',
        'address',
        'est_year',
        'phone_number'
    ];
}
