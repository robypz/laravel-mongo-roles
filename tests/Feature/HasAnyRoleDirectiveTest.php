<?php
use Illuminate\Support\Facades\Blade;
use Workbench\App\Models\User;

it('renders content when user has any of the required roles', function () {
    // Creamos un usuario simulado con el rol 'admin'
    $user = User::where('email', 'test@example.com')->first();

    $this->actingAs($user);

    $compiled = Blade::render("@any_role('role,anotherRole') Bienvenido @endany_role");

    expect($compiled)->toContain('Bienvenido');
});

it('does not render content when user lacks any of the required roles', function () {
    $user = User::where('email', 'unauthorized@example.com')->first();

    $this->actingAs($user);

    $compiled = Blade::render("@any_role('anotherRole,noRole') Bienvenido @endany_role");

    expect($compiled)->not->toContain('Bienvenido');
});