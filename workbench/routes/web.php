<?php

use App\Http\Middleware\AnyPermission;
use App\Http\Middleware\AnyRole;
use App\Http\Middleware\Permission;
use App\Http\Middleware\Role;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


//successfully passes
Route::get('/hasPermission', function () {
    return response(null,200);
})->middleware(['auth','permission:permission']);

Route::get('/hasAnyPermission', function () {
    return response(null,200);
})->middleware(['auth','any_permission:permission,anotherPermission']);

Route::get('/hasRole', function () {
    return response(null,200);
})->middleware(['auth','role:role']);

Route::get('/hasAnyRole', function () {
    return response(null,200);
})->middleware(['auth','any_role:role,anotherRole']);