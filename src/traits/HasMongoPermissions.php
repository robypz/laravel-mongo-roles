<?php

namespace RobYpz\MongoRole\Traits;

use MongoDB\Laravel\Relations\BelongsToMany;
use RobYpz\MongoRole\Models\Permission;

trait HasMongoPermissions
{

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }

    public function hasPermissionTo(string | array $permissions): bool
    {
        if ($this->permissions()->whereIn('name', $permissions)->count() == count($permissions)) {
            return true;
        }
        return false;
    }

    public function hasAnyPermissionTo(string | array $permissions): bool
    {
        if ($this->permissions()->whereIn('name', $permissions)->count() > 0) {
            return true;
        }
        return false;
    }

    public function assignPermissionTo(string | array $permissions): void
    {
        foreach (Permission::whereIn('name', $permissions) as $permission) {
            $this->permissions()->attach($permission);
        }
    }

    public function revokePermissionTo(string | array $permissions): void
    {
        foreach (Permission::whereIn('name', $permissions) as $permission) {
            $this->permissions()->detach($permission);
        }
    }
}
