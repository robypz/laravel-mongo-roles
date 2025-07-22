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
            $permissions = Permission::where('permission', 'in', $permissions)->get();
            foreach ($permissions as $permission) {
                $this->permissions()->attach($permission);
            }
        } elseif (is_string($permissions)) {
            $permissions = Permission::where('permission', $permissions)->first();
            $this->permissions()->attach($permissions);
        }
        return $this->permissions;
    }

    public function hasPermissions(string | array $permissions)
    {
        if (is_array($permissions)) {
            $permissions = Permission::where('permission', 'in', $permissions)->get();
            foreach ($permissions as $permission) {
                $this->permissions()->attach($permission);
            }
        } elseif (is_string($permissions)) {
            $permissions = Permission::where('permission', $permissions)->first();
            $this->permissions()->attach($permissions);
        }
        return $this->permissions;
    }

    public function hasAnyPermissions(string | array $permissions)
    {
        if (is_array($permissions)) {
            $permissions = Permission::where('permission', 'in', $permissions)->get();
            foreach ($permissions as $permission) {
                $this->permissions()->attach($permission);
            }
        } elseif (is_string($permissions)) {
            $permissions = Permission::where('permission', $permissions)->first();
            $this->permissions()->attach($permissions);
        }
        return $this->permissions;
    }
}
