<?php

namespace App\Models\Traits;

use App\Models\Route;

trait Routeable
{
    public function route()
    {
        return $this->hasOne(Route::class, 'slug', 'slug');
    }
}
