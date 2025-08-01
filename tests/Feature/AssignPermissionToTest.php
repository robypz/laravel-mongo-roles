<?php
use Workbench\App\Models\User;

it('assign permission to user', function () {
    $user = User::where('email', 'test@example.com')->first();

    $user->assignPermissionTo(['permission1']);

    expect($user->hasPermissionTo(['permission1']))->toBe(true);
});

it('revoke permission to user', function () {
    $user = User::where('email', 'test@example.com')->first();

    $user->revokePermissionTo(['permission1']);

    expect($user->hasPermissionTo(['permission1']))->toBe(false);

});