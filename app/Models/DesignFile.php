<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DesignFile extends Model
{
    use HasFactory;
    protected $hidden = [
        'fake_file_path',
        'original_file_path'
    ];
    protected $fillable = [
        'design_id',
        'original_file_path',
        'fake_file_path',
        'size',
        'dpi',
        'mime_type',
        'extension'
    ];
    protected $appends = ['link', 'is_in_print_cart'];

    public function design()
    {
        return $this->belongsTo(Design::class) ;
    }

    protected function link(): Attribute
    {
        return Attribute::make(
            get: fn($value) => route('files.download', $this),
        );
    }

    protected function getIsInPrintCartAttribute(

    ) {

        if (request()->user('sanctum'))
            return PrintCart::where('file_id', $this->id)->where('user_id', request()->user('sanctum')->id)->count() > 0;
        else
            return auth('sanctum')->user();
    }
    // protected $appends = ['link'];

    // protected function link(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn($value) => route('files.download', $this),
    //     );
    // }
}
