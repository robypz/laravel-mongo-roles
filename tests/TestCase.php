<?php

namespace Tests;

use Orchestra\Testbench\Concerns\WithWorkbench;
use Illuminate\Contracts\Config\Repository;
use RobYpz\LaravelMongoRole\Providers\MongoRoleServiceProvider;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    use WithWorkbench;

    protected function getPackageProviders($app)
    {
        return [
            MongoRoleServiceProvider::class,
        ];
    }

    protected function defineEnvironment($app)
    {
        tap($app['config'], function (Repository $config) {
            $config->set('database.default', 'testbench');
            $config->set('database.connections.testbench', [
                'driver'   => 'mongodb',
                'database' => ':memory:',
                'prefix'   => '',
            ]);

            $config->set('queue.batching.database', 'testbench');
            $config->set('queue.failed.database', 'testbench');
        });
    }
}
