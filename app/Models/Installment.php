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
        'is_paid',
        'type',
        'title',
        'payment_method',
    ];
    protected $casts=[
        'is_paid'=>'boolean'
    ];
    public function printOrder()
    {
        return $this->belongsTo(PrintOrder::class,'print_order_id');
    }

    public function transactionReceipt()
    {
        return $this->hasOne(TransactionReceipt::class, 'installment_id');
    }
}
