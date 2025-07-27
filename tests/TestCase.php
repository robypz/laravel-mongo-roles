<?php

namespace Tests;

use Orchestra\Testbench\Concerns\WithWorkbench;
use Illuminate\Contracts\Config\Repository;
use RobYpz\MongoRole\Providers\MongoRoleServiceProvider;
use MongoDB\Laravel\MongoDBServiceProvider;
use Illuminate\Foundation\Testing\DatabaseMigrations;

//use function Orchestra\Testbench\workbench_path;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    use WithWorkbench;

    protected function setUp(): void
    {
        parent::setUp();

        // Ejecutar seeders
        $this->seed(\Workbench\Database\Seeders\DatabaseSeeder::class);

    }

    protected function getPackageProviders($app)
    {
        return [
            MongoDBServiceProvider::class,
            MongoRoleServiceProvider::class,
        ];
    }

    protected function defineEnvironment($app)
    {
        tap($app['config'], function (Repository $config) {
            $config->set('database.default', 'testbench');
            $config->set('database.connections.testbench', [
                'driver'   => 'mongodb',
                'database' => 'laravel_mongo_role_test',
                'dsn'      => 'mongodb://localhost:27017',
            ]);

            $config->set('queue.batching.database', 'testbench');
            $config->set('queue.failed.database', 'testbench');
        });
    }

    /*protected function defineDatabaseMigrations()
    {
        $this->loadMigrationsFrom(
            workbench_path('database/migrations')
        );
    }*/
}
