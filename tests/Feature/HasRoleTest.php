<?php

use Workbench\App\Models\User;

it('returns a successful response', function () {

    $user = User::where('email', 'test@example.com')->first();

    $this->actingAs($user);

    $response = $this->get('/hasRole');

    $response->assertStatus(200);
});
