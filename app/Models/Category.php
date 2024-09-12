<?php

namespace App\Models;

use App\Models\Traits\Fileable;
use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory, Filterable,Fileable;
    protected $fillable = [
        'name',
        'parent_id',
        'type',
        'slug',
        'color'
    ];

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id')->with('children');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }
    
    public function image(){
        
        return $this->files()->withPivotValue('section','image');
    }


    protected static function boot()
    {

        parent::boot();
        static::creating(function ($model) {
            $model->fill([
                'slug' => Str::slug($model->name, '-', null)
            ]);
        });

        static::updating(function ($model) {
            $model->fill([
                'slug' => Str::slug($model->name, '-', null)
            ]);
        });
    }
}
