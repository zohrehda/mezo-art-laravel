<?php

namespace App\Models;

use App\Models\Traits\Fileable;
use App\Models\Traits\Filterable;
use App\Models\Traits\Taggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DesignFile;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Design extends Model
{
    use HasFactory, Filterable, Taggable, Fileable;

    protected $fillable = [
        'code',
        'print_type',
        'design_type',
        'downloadable',
        'status',
        'private',
        'designer_id',
        'package',
        'category_id',
        'colors',
        'pinterest_link',
    ];

    protected $appends = ['tag_ids'];
    protected $attributes = ['downloadable' => 1, 'code' => 33];

    public function siteFiles()
    {
        return $this->files()->where('section', 'site');
    }

    public function printFiles()
    {
        return $this->hasMany(DesignFile::class, 'design_id');
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    protected function tagIds(): Attribute
    {
        return new Attribute(
            get: fn() => $this->tags->pluck('id')
        );
    }

    protected function colors(): Attribute
    {
        return new Attribute(
            set: fn($value) => json_encode($value),
            get: fn($value) => json_decode($value, true),
        );
    }


}
