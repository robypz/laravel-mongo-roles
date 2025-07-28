<?php

use App\Http\Middleware\HasAnyPermission;
use App\Http\Middleware\HasAnyRole;
use App\Http\Middleware\HasPermission;
use App\Http\Middleware\HasRole;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


//successfully passes
Route::get('/hasPermission', function () {
    return response(null,200);
})->middleware(['auth','has-permission:permission']);

Route::get('/hasAnyPermission', function () {
    return response(null,200);
})->middleware(['auth','has-any-permission:permission,anotherPermission']);

Route::get('/hasRole', function () {
    return response(null,200);
})->middleware(['auth','has-role:role']);

Route::get('/hasAnyRole', function () {
    return response(null,200);
})->middleware(['auth','has-any-role:role,anotherRole']);