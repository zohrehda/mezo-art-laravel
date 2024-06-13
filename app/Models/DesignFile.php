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
        'name',
        'size',
        'code',
        'dpi',
        'mime_type',
        'width',
        'height',
        'extension'
    ];
    protected $appends = ['link', 'is_in_print_cart'];

    public function design()
    {
        return $this->belongsTo(Design::class);
    }



    protected function link(): Attribute
    {
        //  return storage_path($this->fake_file_path);

        return Attribute::make(
            get: fn($value) => route('design_files.download', $this),
            // get: fn($value) => storage_path($this->fake_file_path),

        );
    }

    protected static function boot()
    {

        parent::boot();
        // static::creating(function ($model) {
        //     $print_file_name = $model->print_type == 'sub' ? ($model->design_type == 'single' ? 'SO' : 'ST') : 'DT';
        //     $model->fill([
        //         'code' => $print_file_name . rand(100000, 999999)
        //     ]);
        // });

        // static::updating(function ($model) {
        //     $print_file_name = $model->print_type == 'sub' ? ($model->design_type == 'single' ? 'SO' : 'ST') : 'DT';
        //     $model->fill([
        //         'code' => $print_file_name . substr($model->code, 2)
        //     ]);
        // });
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
