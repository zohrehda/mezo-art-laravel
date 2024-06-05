<?php

namespace App\Models;

use App\Models\Traits\Fileable;
use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class Route extends Model
{
    use HasFactory, Fileable, Filterable;
    protected $fillable = [
        'slug',
        'title',
        'description',
        'redirect_code',
        'redirect_url',
        'page_builder_id'
    ];

    public function pageBuilder()
    {
        return $this->belongsTo(PageBuilder::class,'page_builder_id');
    }
}
