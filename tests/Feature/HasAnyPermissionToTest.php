<?php

use Workbench\App\Models\User;

it('return a forbidden response ', function () {

    $user = User::where('email', 'test@example.com')->first();

    $this->actingAs($user);

    $response = $this->get('/hasAnyPermissionTo');

    $response->assertStatus(200);
});