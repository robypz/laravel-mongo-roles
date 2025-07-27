<?php
namespace RobYpz\MongoRole\Models;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\BelongsToMany;

Class Role extends Model {

    public function permissions() : BelongsToMany {
        return $this->belongsToMany(Permission::class);
    }
}