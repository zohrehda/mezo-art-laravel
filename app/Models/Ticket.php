<?php

namespace App\Models;

use App\Enums\Tickets\TicketStatus;
use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Builder;
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

    // protected $casts = [
    //     'created_at' => 'date_format:d/m/yyyy',
    // ];

    protected static function booted(): void
    {
        static::addGlobalScope('access', function (Builder $builder) {
            $builder->where('user_id',auth()->user()->id );
        });
    }

    protected $attributes = [
        'status' => TicketStatus::PENDING
    ];

    public function messages()
    {
        return $this->hasMany(TicketMessage::class);
    }
}
