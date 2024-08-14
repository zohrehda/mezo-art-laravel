<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrintOrderProcess extends Model
{
    use HasFactory;
    protected $fillable = [
        'print_order_id',
        'print_order_assessment_id',
        'printing_house_reference_date',
        'fabric_placement_date',
        'observer_presence_date',
        'deliveryـtime_date',
        'estimatedـdeliveryـtime_date'
    ];

    protected $casts=[
        'printing_house_reference_date'=>'datetime' ,
        'fabric_placement_date'=>'datetime' ,
        'observer_presence_date'=>'datetime' ,
        'deliveryـtime_date'=>'datetime' ,
        'estimatedـdeliveryـtime_date'=>'datetime' ,
    ] ;
}
