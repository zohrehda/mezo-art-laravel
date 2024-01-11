<?php

namespace App\Traits;
use Illuminate\Database\Eloquent\Casts\Attribute;


trait ModelObserver
{
    protected static function boot()
    {
      
        parent::boot();
        static::creating(function ($model) {
            
            $model->fill([
                'created_by' => apiAuth()->id??null,
            ]);
        });
    }

    public function userId()
    {
        return Attribute::make(
            set: fn () => apiAuth()->id,
        );
    }

}
