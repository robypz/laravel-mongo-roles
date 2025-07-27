<?php

namespace Workbench\Database\Seeders;

use Illuminate\Database\Seeder;
use RobYpz\MongoRole\Models\Permission;
use RobYpz\MongoRole\Models\Role;
use Workbench\Database\Factories\UserFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // UserFactory::new()->times(10)->create();

        $user = UserFactory::new()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        //create role and permission
        $role = Role::create([
            'name'=> 'role'
        ]);

        $permission = Permission::create([
            'name'=> 'permission'
        ]);

        $role->permissions()->attach($permission);

        $user->roles()->attach($role);

    }
}
