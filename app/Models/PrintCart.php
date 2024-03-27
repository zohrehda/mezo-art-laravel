<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrintCart extends Model
{
    use HasFactory, Filterable;
    protected $fillable = [
        'user_id',
        'file_id'
    ];
    public function file()
    {
        return $this->belongsTo(DesignFile::class, 'file_id');
    }
    public function design()
    {
        return $this->hasOneThrough(Design::class, DesignFile::class, 'id', 'id', 'file_id', 'design_id');
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'print_type' => $this->design->print_type,
            'design_type' => $this->design->design_type,
            'link' => $this->file->link,
        ];
    }
}
