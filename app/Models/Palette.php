<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Palette extends Model
{
    use HasFactory, Filterable;
    public $table = 'palette';

    public function scopeModelFilter(Builder $query)
    {
        $search = request()->input('search');
        if ($search)
            $query->where('name', 'like', "%$search%");
    }
}
