<?php

namespace App\Models\Views;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserView extends User
{
    public $table='users_v' ;       
}