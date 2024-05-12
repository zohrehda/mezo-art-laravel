<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrintOrder extends Model
{
    use HasFactory, Filterable;
    protected $fillable = [
        'user_id',
        'design_type',
        'print_type'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jsonSerialize(): mixed
    {

        return [
            ...$this->toArray(),
            'print_type_fa' => trans("messages.print_type." . $this->print_type),
            'design_type_fa' => trans("messages.design_type." . $this->design_type)
        ];
    }
}
