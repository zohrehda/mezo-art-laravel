<?php

namespace App\Models;

use App\Models\Traits\Filterable;
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
    use HasFactory, Filterable;
    protected $fillable = [
        'title',
        'content',
        'slug',
        'category_id',
        'author_id'
    ];
    protected $appends = ['tag_ids', 'category_name', 'excerpt', 'create_date', 'read_time'];
    protected function tagIds(): Attribute
    {
        return new Attribute(
            get: fn() => $this->tags->pluck('id')
        );
    }

    protected function categoryName(): Attribute
    {
        return new Attribute(
            get: fn() => $this->category->name
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


}
