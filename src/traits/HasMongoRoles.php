<?php

use MongoDB\Laravel\Relations\BelongsToMany;
use RobYpz\MongoRole\Models\Role;

trait HasMongoRoles
{

    use HasMongoPermissions;

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function assignRoles(string | array $roles) 
    {
        if (is_array($roles)) {
            $roles = Role::where('name', 'in', $roles)->get();
            foreach ($roles as $role) {
                $this->roles()->attach($role);
            }
        } elseif (is_string($roles)) {
            $roles = Role::where('name', $roles)->first();
            $this->roles()->attach($roles);
        }

        return $this->roles;
    }



    public function hasRoles(string | array $roles): bool
    {
        if (is_array($roles)) {
            if ($this->roles()->where('name', 'in', $roles)->count() == count($roles)) {
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
            if ($this->roles()->where('name', 'in', $roles)->count() > 0) {
                return true;
            }
        } elseif (is_string($roles)) {
            if ($this->roles()->where('name', $roles)->count() > 0) {
                return true;
            }
        }
        return false;
    }
}
