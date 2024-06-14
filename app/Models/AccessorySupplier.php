<?php

namespace App\Models;

use App\Enums\UserRole;
use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessorySupplier extends Model
{
    use HasFactory ,Filterable;
    protected $fillable = [
        'title',
        'description',
        'type',
        'description',
        'user_id',
        'design_id',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    protected static function booted(): void
    {
        static::addGlobalScope('access', function (Builder $builder) {
            $user = request()->user('sanctum');

            if ($user && $user->role == UserRole::ADMIN->value)
                return $builder;
            else
                $builder->where('status', true);
        });
    }

}
