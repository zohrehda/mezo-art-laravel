<?php

namespace App\Models\Views;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;

class RouteView extends Model
{
    use Filterable ;
    public $table = 'routes_v';
}