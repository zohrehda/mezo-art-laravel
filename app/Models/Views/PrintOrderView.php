<?php

namespace App\Models\Views;

use App\Models\PrintOrder;
use Illuminate\Database\Eloquent\Model;

class PrintOrderView extends PrintOrder
{
    public $table = 'print_orders_v';
    protected $primaryKey = 'id';
}