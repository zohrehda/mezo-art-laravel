<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory,Filterable;
    protected $fillable = [
        'email',
        'hash',
        'verified_at',
    ];
}
