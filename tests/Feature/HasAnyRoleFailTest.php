<?php

use Workbench\App\Models\User;

it('return a forbidden response ', function () {

    $user = User::where('email', 'unauthorized@example.com')->first();

    $this->actingAs($user);

    $response = $this->get('/hasAnyRole');

    $response->assertStatus(403);
});
