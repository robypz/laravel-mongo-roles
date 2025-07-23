<?php

use MongoDB\Laravel\Relations\BelongsToMany;
use RobYpz\MongoRole\Models\Permission;

trait HasMongoPermissions
{

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }

    public function assignPermissions(string | array $permissions)
    {
        if (is_array($permissions)) {
            $permissions = Permission::where('name', 'in', $permissions)->get();
            foreach ($permissions as $permission) {
                $this->permissions()->attach($permission);
            }
        } elseif (is_string($permissions)) {
            $permissions = Permission::where('name', $permissions)->first();
            $this->permissions()->attach($permissions);
        }
        return $this->permissions;
    }

    public function hasPermissions(string | array $permissions)
    {
        if (is_array($permissions)) {
            $lengt = count($permissions);
            $permissions = $this->permissions()->where('name', 'in', $permissions)->count();
            if ($permissions == $lengt) {
                return true;
            }
        } elseif (is_string($permissions)) {
            $permissions = $this->permissions()->where('name', 'in', $permissions)->count();
            if ($permissions > 0) {
                return true;
            }
        }
        return false;
    }

    public function hasAnyPermissions(string | array $permissions)
    {
        if (is_array($permissions)) {
            $permissions = $this->permissions()->where('name', 'in', $permissions)->count();
            if ($permissions > 0) {
                return true;
            }
        } elseif (is_string($permissions)) {
            $permissions = $this->permissions()->where('name', 'in', $permissions)->count();
            if ($permissions > 0) {
                return true;
            }
        }
        return false;
    }
}
