<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Str;

class Tag extends Model
{
    use HasFactory, Filterable;
    protected $fillable = [
        'name',
        'slug',
    ];

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

    public function blogs()
    {
        return $this->morphedByMany(Blog::class, 'taggable');
    }

    // ilters[slug]=gg&


}
