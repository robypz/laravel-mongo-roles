<?php

use Workbench\App\Models\User;

it('return a forbidden response ', function () {

    $user = User::where('email', 'unauthorized@example.com')->first();

    $this->actingAs($user);

    $response = $this->get('/hasPermission');

    $response->assertStatus(403);
});
