<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionReceipt extends Model
{
    use HasFactory;
    protected $fillable = [
        'installment_id',
        'amount',
        'transaction_num',
        'payment_date'
    ];

    public function installment()
    {
        return $this->belongsTo(Installment::class, 'installment_id');
    }
}
