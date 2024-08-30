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
        'transaction_num',
        'payment_date',

    ];

    public function printOrder()
    {
        return $this->belongsTo(PrintOrder::class);
    }

    public function transactionReceipt()
    {
        return $this->hasOne(TransactionReceipt::class, 'installment_id');
    }
}
