<?php

namespace App\Traits;

use App\Models\Permission;
use App\Models\Role;

trait HasRoles
{
    public function permissions()
    {
        return $this->morphedByMany(Permission::class, 'userable', 'user_accesses')->withTimestamps();
    }

    public function roles()
    {
        return   $this->morphedByMany(Role::class, 'userable', 'user_accesses')->withTimestamps();
    }

    public function hasPermission($permissionName): bool
    {
        return  $this->permissions()->where('name', $permissionName)->count() > 0 or
            $this->roles()->whereHas('permissions', function ($query) use ($permissionName) {
                $query->where('name', $permissionName);
            })->count();
    }

    public function hasRole($roleName): bool
    {
        return  $this->roles()->where('name', $roleName)->count() > 0;
    }
}
