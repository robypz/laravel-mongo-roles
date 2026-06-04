<?php
namespace RobYpz\MongoRole\Models;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\BelongsToMany;

Class Permission extends Model {

    public function roles() : BelongsToMany {
        return $this->belongsToMany(Role::class);
    }
}