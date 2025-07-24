<?php

namespace Tests;

use Orchestra\Testbench\Concerns\WithWorkbench;
use Illuminate\Contracts\Config\Repository;
use RobYpz\LaravelMongoRole\Providers\MongoRoleServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use MongoDB\Laravel\MongoDBServiceProvider;
use Orchestra\Testbench\Attributes\WithMigration; 

#[WithMigration] 
abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    use WithWorkbench,RefreshDatabase;

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
                'host'     => '127.0.0.1',
                'port'     => '27017',
            ]);

            $config->set('queue.batching.database', 'testbench');
            $config->set('queue.failed.database', 'testbench');
        });
    }
}
