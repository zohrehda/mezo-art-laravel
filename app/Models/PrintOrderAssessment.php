<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrintOrderAssessment extends Model
{
    use HasFactory;
    protected $fillable = [
        'print_order_id',
        'approval_method',
        'operator_approval_date',
        'warehouse_approval_date',
        'sample_approval_date',
        'description',
        'payment_method',
        'prepayment_amount',
        'sub_total' ,
        'additional_services_cost'
    ];

    public function printOrder()
    {
        return $this->belongsTo(PrintOrder::class);
    }

    public function setSampleApprovalDateAttribute($value)
    {
        $this->attributes['sample_approval_date'] = $value ? Carbon::now() : null;
    }

    public function setOperatorApprovalDateAttribute($value)
    {
        $this->attributes['operator_approval_date'] = $value ? Carbon::now() : null;
    }

    public function setWarehouseApprovalDateAttribute($value)
    {
        $this->attributes['warehouse_approval_date'] = $value ? Carbon::now() : null;
    }
}
