<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, Filterable;
    protected $fillable = [
        'name',
        'parent_id',
        'type'
    ];

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id')->with('children');
    }
}
