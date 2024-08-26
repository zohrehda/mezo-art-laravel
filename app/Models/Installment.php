<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Installment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'print_order_id',
        'amount',
        'is_paid'
    ];

    public function printOrder()
    {
        return $this->belongsTo(PrintOrder::class);
    }
}
