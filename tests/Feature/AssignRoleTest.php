<?php
use Workbench\App\Models\User;

it('assign role to user', function () {
    $user = User::where('email', 'test@example.com')->first();

    $user->assignRole(['role1']);

    expect($user->hasrole(['role1']))->toBe(true);
});

it('revoke role to user', function () {
    $user = User::where('email', 'test@example.com')->first();

    $user->revokeRole(['role1']);

    expect($user->hasrole(['role1']))->toBe(false);

});