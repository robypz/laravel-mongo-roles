<?php
use Illuminate\Support\Facades\Blade;
use Workbench\App\Models\User;

it('renders content when user has the required role', function () {
    // Creamos un usuario simulado con el rol 'admin'
    $user = User::where('email', 'test@example.com')->first();

    $this->actingAs($user);

    $compiled = Blade::render("@role('role') Bienvenido @endrole");

    expect($compiled)->toContain('Bienvenido');
});

it('does not render content when user lacks the required role', function () {
    $user = User::where('email', 'unauthorized@example.com')->first();

    $this->actingAs($user);

    $compiled = Blade::render("@role('noRole') Bienvenido @endrole");

    expect($compiled)->not->toContain('Bienvenido');
});