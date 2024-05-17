<?php

namespace App\Models;

use App\Enums\UserRole;
use App\Models\Traits\Fileable;
use App\Models\Traits\Filterable;
use App\Models\Traits\Routeable;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory, Filterable, Fileable, Routeable;
    protected $fillable = [
        'title',
        'content',
        'slug',
        'category_id',
        'author_id',
        'status',
        'meta_title',
        'meta_description'
    ];
    protected $appends = ['tag_ids', 'category_name', 'excerpt', 'create_date', 'read_time', 'thumbnail_image', 'poster_image'];
    protected function tagIds(): Attribute
    {
        return new Attribute(
            get: fn() => $this->tags->pluck('id')
        );
    }
    protected function thumbnailImage(): Attribute
    {
        return new Attribute(
            get: fn() => $this->thumbnail[0]->link ?? ''
        );
    }
    protected function posterImage(): Attribute
    {
        return new Attribute(
            get: fn() => $this->poster[0]->link ?? ''
        );
    }
    public function thumbnail()
    {
        return $this->files()->withPivotValue('section', 'thumbnail');

        // return $this->files() ;
        return $this->morphOne(File::class, 'fileable')->where('section', 'thumbnail');
    }

    public function poster()
    {
        return $this->files()->withPivotValue('section', 'poster');
        return $this->morphOne(File::class, 'fileable')->where('section', 'poster');
    }

    protected function categoryName(): Attribute
    {
        return new Attribute(
            get: fn() => $this->category->name ?? ''
        );
    }
    protected function excerpt(): Attribute
    {
        return new Attribute(
            get: fn() => Str::words($this->content, 3000)
        );
    }

    protected function createDate(): Attribute
    { //formatWord('l dS F');
        return new Attribute(
            get: fn() => verta($this->created_at)->format('%d %B، %Y')
        );
    }

    protected function readTime(): Attribute
    { //formatWord('l dS F');
        return new Attribute(
            get: fn() => Str::readDuration($this->content)
        );
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeModelFilter(Builder $query)
    {
        $search = request()->input('search');
        if ($search)
            $query->where('title', 'like', "%$search%")->orWhere('content', 'like', "%$search%");
    }

    protected static function booted(): void
    {
        static::addGlobalScope('access', function (Builder $builder) {
            $user = request()->user('sanctum');

            if ($user && $user->role == UserRole::ADMIN->value)
                return $builder;
            else
                $builder->where('status', true);
        });
    }


}
