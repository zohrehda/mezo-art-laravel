<?php

namespace App\Models\Traits;

use App\Models\Like;


trait Likeable
{
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable') ;
    }

    public function like()
    {
        $this->likes()->firstOrCreate([
            'user_id' => auth()->user()->id
        ]);
    }

    public function unlike()
    {
        $this->likes()->where('user_id', auth()->user()->id)->delete();
    }

    public function likeCount()
    {
        return $this->likes()->count();
    }

    public function likedBy()
    {
        return $this->likes()->where('user_id', auth()->user()->id)->count() > 0;
    }
}
