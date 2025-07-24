<?php

namespace RobYpz\LaravelMongoRole\Providers;

use Illuminate\Support\ServiceProvider;

class MongoRoleServiceProvider extends ServiceProvider
{
    public function register() {}

    public function boot()
    {
        $this->publishesMigrations([
            __DIR__ . '/../database/migrations' => database_path('migrations'),
        ]);
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
}
