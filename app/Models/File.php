<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PrintCart;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'fileable_type',
        'fileable_id',
        'path',
        'size',
        'extension',
        'section',
        'mime_type',
        'user_id'
    ];
    protected $appends = ['link', 'is_in_print_cart'];

    protected function link(): Attribute
    {
        return Attribute::make(
            get: fn($value) => route('files.download', $this),
        );
    }

    protected function getIsInPrintCartAttribute()
    {
        return PrintCart::where('file_id', $this->id)->where('user_id', 1)->count() > 0;
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->fill([
                'user_id' => request()->user('sanctum')->id ?? null
            ]);
        });
    }

    // protected function isInPrintCart(): Attribute
    // { //  PrintCart::where('file_id', $this->id)->where('user_id', 1)->count() >0
    //     return Attribute::make(
    //         get: fn() => true,
    //     );
    // }

}
