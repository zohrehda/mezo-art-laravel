<?php

namespace App\Models\Views;

use App\Models\Design;
use Illuminate\Database\Eloquent\Model;

class DesignView extends Design
{
    protected $primaryKey='id';
    public $table='designs_v' ;  
    
    public function getMorphClass(){
        return Design::class ;
    }
}