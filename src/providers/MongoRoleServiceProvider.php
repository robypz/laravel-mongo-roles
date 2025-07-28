<?php

namespace RobYpz\MongoRole\Providers;

use Illuminate\Support\ServiceProvider;
use RobYpz\MongoRole\Middleware\HasAnyPermission;
use RobYpz\MongoRole\Middleware\HasAnyRole;
use RobYpz\MongoRole\Middleware\HasPermission;
use RobYpz\MongoRole\Middleware\HasRole;

class MongoRoleServiceProvider extends ServiceProvider
{
    public function register() {}

    public function boot()
    {
        $this->publishesMigrations([
            __DIR__ . '/../database/migrations' => database_path('migrations'),
        ]);
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $router = $this->app['router'];
        $router->aliasMiddleware('has-role', HasRole::class);
        $router->aliasMiddleware('has-any-role', HasAnyRole::class);
        $router->aliasMiddleware('has-permission', HasPermission::class);
        $router->aliasMiddleware('has-any-permission', HasAnyPermission::class);
    }
}
