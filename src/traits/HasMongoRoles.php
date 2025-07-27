<?php

namespace RobYpz\MongoRole\Traits;

use MongoDB\Laravel\Relations\BelongsToMany;
use RobYpz\MongoRole\Models\Role;

trait HasMongoRoles
{
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }


    public function hasRoles(string | array $roles): bool
    {
        if (is_array($roles)) {
            if ($this->roles()->whereIn('name', $roles)->count() == count($roles)) {
                return true;
            }
        } elseif (is_string($roles)) {
            if ($this->roles()->where('name', $roles)->count() > 0) {
                return true;
            }
        }
        return false;
    }

    public function hasAnyRoles(string | array $roles): bool
    {
        if (is_array($roles)) {
            if ($this->roles()->whereIn('name', $roles)->count() > 0) {
                return true;
            }
        } elseif (is_string($roles)) {
            if ($this->roles()->where('name', $roles)->count() > 0) {
                return true;
            }
        }
        return false;
    }

    public function roleHasPermissions(string | array $permissions)
    {
        if (is_array($permissions)) {
            $lengt = count($permissions);
            $permissions = $this->roles()->permissions()->whereIn('name', $permissions)->count();
            if ($permissions == $lengt) {
                return true;
            }
        } elseif (is_string($permissions)) {
            $permissions = $this->roles()->permissions()->whereIn('name', $permissions)->count();
            if ($permissions > 0) {
                return true;
            }
        }
        return false;
    }

    public function roleHasAnyPermissions(string | array $permissions)
    {
        if (is_array($permissions)) {
            $permissions = $this->roles()->permissions()->where('name', 'in', $permissions)->count();
            if ($permissions > 0) {
                return true;
            }
        } elseif (is_string($permissions)) {
            $permissions = $this->roles()->permissions()->where('name', 'in', $permissions)->count();
            if ($permissions > 0) {
                return true;
            }
        }
        return false;
    }
}
