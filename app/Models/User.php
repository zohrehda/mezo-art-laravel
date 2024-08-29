<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'mobile',
        'username',
        'brith_date',
        'password',
        'role',
        'last_login_at',
        'is_ban'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $attributes = [
        'role' => 'user'
    ];

    protected $appends = [
        'profile',
        'has_password',
        'city',
        'province',

    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function meta()
    {
        return $this->hasOne(UserMeta::class);
    }
    protected function profile(): Attribute
    {
        return new Attribute(
            get: fn() => $this->image->link ?? ''
        );
    }

    protected function city(): Attribute
    {
        return new Attribute(
            get: fn() => $this->meta->city->name ?? ''
        );
    }

    protected function province(): Attribute
    {
        return new Attribute(
            get: fn() => $this->meta->province->name ?? ''
        );
    }

    protected function hasPassword(): Attribute
    {
        return new Attribute(
            get: fn() => !!$this->password
        );
    }

    public function image()
    {
        return $this->morphOne(File::class, 'fileable');
    }

    public function print_orders()
    {
        return $this->belongsTo(PrintOrder::class);
    }



    // protected $appends = ['fullName'];
    // protected function fullName(): Attribute
    // {
    //     return new Attribute(
    //         get: fn() => $this->tags->pluck('id')
    //     );
    // }
}

