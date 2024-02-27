<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory, Filterable;

    protected $fillable = [
        'subject',
        'uuid',
        'title',
        'priority',
        'ref',
        'user_id',
        'status',
        'is_resolved',
    ];
    public function messages()
    {
        return $this->hasMany(TicketMessage::class);
    }
}
