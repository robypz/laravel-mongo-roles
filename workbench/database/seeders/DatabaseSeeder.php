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

        UserFactory::new()->create([
            'name' => 'Unauthorized User',
            'email' => 'unauthorized@example.com',
        ]);

        //create role and permission
        $role = Role::create([
            'name' => 'role'
        ]);

        $role1 = Role::create([
            'name' => 'role1'
        ]);

        $permission = Permission::create([
            'name' => 'permission'
        ]);

        $permission1 = Permission::create([
            'name' => 'permission1'
        ]);

        $role->permissions()->attach($permission);

        $user->roles()->attach($role);
        $user->roles()->attach($role1);

        $user->permissions()->attach($permission);
        $user->permissions()->attach($permission1);
    }
}
