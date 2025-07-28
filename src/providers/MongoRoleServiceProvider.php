<?php

namespace RobYpz\MongoRole\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use RobYpz\MongoRole\Middleware\AnyPermission;
use RobYpz\MongoRole\Middleware\AnyRole;
use RobYpz\MongoRole\Middleware\Permission;
use RobYpz\MongoRole\Middleware\Role;


class MongoRoleServiceProvider extends ServiceProvider
{
    public function register() {}

    public function boot()
    {
        //Publish Migrations
        $this->publishesMigrations([
            __DIR__ . '/../database/migrations' => database_path('migrations'),
        ]);

        //Migrations
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        //Middlewares
        $router = $this->app['router'];
        $router->aliasMiddleware('role', Role::class);
        $router->aliasMiddleware('any_role', AnyRole::class);
        $router->aliasMiddleware('permission', Permission::class);
        $router->aliasMiddleware('any_permission', AnyPermission::class);

        //Blade directives

        Blade::if('any_role', function ($roles) {
            $roles = is_string($roles) ? array_map('trim', explode(',', $roles)) : $roles;
            return auth()->check() && auth()->user()->hasAnyRole($roles);
        });

        Blade::if('role', function ($roles) {
            $roles = is_string($roles) ? array_map('trim', explode(',', $roles)) : $roles;
            return auth()->check() && auth()->user()->hasRole($roles);
        });


        Blade::if('permission', function ($permissions) {
            $permissions = is_string($permissions) ? array_map('trim', explode(',', $permissions)) : $permissions;
            return auth()->check() && auth()->user()->hasPermission($permissions);
        });

        Blade::if('any_permission', function ($permissions) {
            $permissions = is_string($permissions) ? array_map('trim', explode(',', $permissions)) : $permissions;
            return auth()->check() && auth()->user()->hasAnyPermission($permissions);
        });
    }
}
