<?php

namespace RobYpz\MongoRole\Traits;

use MongoDB\Laravel\Relations\BelongsToMany;
use RobYpz\MongoRole\Models\Role;

trait HasMongoRoles
{
    use HasMongoPermissions;
    
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }


    public function hasRole(string | array $roles): bool
    {
        if ($this->roles()->whereIn('name', $roles)->count() == count($roles)) {
            return true;
        }
        return false;
    }

    public function hasAnyRole(string | array $roles): bool
    {
        if ($this->roles()->whereIn('name', $roles)->count() > 0) {
            return true;
        }
        return false;
    }

    public function hasPermission(string|array $permissions): bool
    {
        foreach ($this->roles as $role) {
            if ($role->permissions()->whereIn('name', $permissions)->count() == count($permissions)) {
                return true;
            }
        }
        return false;
    }


    public function hasAnyPermission(string | array $permissions) : bool
    {
        foreach ($this->roles as $role) {
            if ($role->permissions()->whereIn('name', $permissions)->count() > 0) {
                return true;
            }
        }
        return false;
    }

    public function assignRole(string | array $roles): void  {
        foreach (Role::whereIn('name', $roles) as $role) {
            $this->roles()->attach($role);
        }
    }

    public function revokeRole(string | array $roles): void  {
        foreach (Role::whereIn('name', $roles) as $role) {
            $this->roles()->detach($role);
        }
    }
}
