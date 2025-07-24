<?php

namespace Tests;

use Orchestra\Testbench\Concerns\WithWorkbench;
use Illuminate\Contracts\Config\Repository; 

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    use WithWorkbench;

    protected function getPackageProviders($app) 
    {
        return [
            'Robypz\LaravelMongoRoles\Providers\MongoRoleServiceProvider'
        ];
    }

    protected function defineEnvironment($app) 
    {
        // Setup default database to use sqlite :memory:
        tap($app['config'], function (Repository $config) { 
            $config->set('database.default', 'testbench'); 
            $config->set('database.connections.testbench', [ 
                'driver'   => 'mongodb', 
                'database' => ':memory:', 
                'prefix'   => '', 
            ]); 
            
            // Setup queue database connections.
            $config([ 
                'queue.batching.database' => 'testbench', 
                'queue.failed.database' => 'testbench', 
            ]); 
        });
    }
}
