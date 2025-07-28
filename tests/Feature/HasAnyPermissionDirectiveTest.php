<?php
use Illuminate\Support\Facades\Blade;
use Workbench\App\Models\User;

it('renders content when user has the required permission', function () {
    // Creamos un usuario simulado con el rol 'admin'
    $user = User::where('email', 'test@example.com')->first();

    $this->actingAs($user);

    $compiled = Blade::render("@any_permission('permission,anotherPermission') Bienvenido @endany_permission");

    expect($compiled)->toContain('Bienvenido');
});

it('does not render content when user lacks the required permission', function () {
    $user = User::where('email', 'unauthorized@example.com')->first();

    $this->actingAs($user);

    $compiled = Blade::render("@any_permission('noPermission,anotherPermission') Bienvenido @endany_permission");

    expect($compiled)->not->toContain('Bienvenido');
});