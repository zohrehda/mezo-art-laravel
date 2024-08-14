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
        'operator_approval',
        'warehouse_approval_date',
        'financial_approval_date',
        'financial_approval',
        'warehouse_approval',
        'sample_approval_date',
        'sample_approval',
        'description',
        'payment_method',
        'prepayment_amount',
        'additional_services_cost',
        'sub_total',
        'total_amount',
        'amount_per_meter',
        'amount_per_file',
        'credit_payment',
        'preparation_time'
    ];

    protected $casts = [
        'amount_per_file' => 'json',
        'credit_payment' => 'boolean'
    ];



    public function printOrder()
    {
        return $this->belongsTo(PrintOrder::class);
    }

    public function setSampleApprovalAttribute($value)
    {
        $this->attributes['sample_approval_date'] = $value ? Carbon::now() : null;
    }
    public function setFinancialApprovalAttribute($value)
    {
        $this->attributes['financial_approval_date'] = $value ? Carbon::now() : null;
    }

    public function setOperatorApprovalAttribute($value)
    {
        $this->attributes['operator_approval_date'] = $value ? Carbon::now() : null;
    }

    public function setWarehouseApprovalAttribute($value)
    {
        $this->attributes['warehouse_approval_date'] = $value ? Carbon::now() : null;
    }
}
