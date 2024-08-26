<?php

namespace App\Models;

use App\Enums\PrintOrderStatus;
use App\Model\Relations\HasManyRelationship;
use App\Models\Relations\HasManySyncableRelationship;
use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrintOrder extends Model
{
    use HasFactory, Filterable, HasManySyncableRelationship;
    protected $fillable = [
        'user_id',
        'design_type',
        'print_type',
        'code',
        'fabric_country_of_origin',
        'fabric_colorability',
        'fabric_weight',
        'fabric_color',
        'fabric_shrink',
        'fabric_material_id',
        'press',
        'updated_by',
        'created_by',
        'admin_access',
        'status',
        'user_access'
    ];

    protected $casts = [
        'press' => 'boolean',
        'admin_access' => 'boolean',
        'user_access' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function roll()
    {
        return $this->hasOne(PrintOrderRoll::class, 'print_order_id');
    }

    public function installments()
    {
        return $this->hasManySyncable(Installment::class);
    }

    public function patterns()
    {
        return $this->hasManySyncable(PrintOrderPattern::class, 'print_order_id');
    }

    public function assessment()
    {
        return $this->hasOne(PrintOrderAssessment::class);
    }

    public function process()
    {
        return $this->hasOne(PrintOrderProcess::class);
    }


    public function orderFiles()
    {
        // return $this->belongsToMany(DesignFile::class, 'print_order_files');

        return $this->hasManySyncable(PrintOrderFile::class, 'print_order_id');
    }

    public function jsonSerialize(): mixed
    {

        return [
            ...$this->toArray(),
            'print_type_fa' => trans("messages.print_type." . $this->print_type),
            'design_type_fa' => trans("messages.design_type." . $this->design_type),
            'user_can_edit' => $this->status == PrintOrderStatus::IN_PROGRESS,
            'admin_can_edit' => $this->admin_access,
            'user_can_complete' =>
                ($this->assessment->operator_approval_date ?? false) and
                ($this->assessment->warehouse_approval_date ?? false) and
                ($this->assessment->financial_approval_date ?? false)
            ,


            // 'user_can_complete' => $this->assessment->operator_approval_date ?? false and
            //     $this->assessment->$this->assessment->warehouse_approval_date ?? false and
            //     $this->assessment->$this->assessment->financial_approval_date ?? false
        ];
    }
}
