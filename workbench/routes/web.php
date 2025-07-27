<?php

use App\Http\Middleware\HasAnyPermission;
use App\Http\Middleware\HasAnyRole;
use App\Http\Middleware\HasPermission;
use App\Http\Middleware\HasRole;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
//passes
Route::get('/hasPermission', function () {
    return response(null,200);
})->middleware(HasPermission::class.':permission');

Route::get('/hasAnyPermission', function () {
    return response(null,200);
})->middleware(HasAnyPermission::class.':permission,anotherPermission');

Route::get('/hasRole', function () {
    return response(null,200);
})->middleware(HasRole::class.':role');

Route::get('/hasAnyRole', function () {
    return response(null,200);
})->middleware(HasAnyRole::class.':role,anotherRole');

//fails
Route::get('/hasPermission', function () {
    return response(null,200);
})->middleware(HasPermission::class.':noPermission');

Route::get('/hasAnyPermission', function () {
    return response(null,200);
})->middleware(HasAnyPermission::class.':noPermission,noAnotherPermission');

Route::get('/hasRole', function () {
    return response(null,200);
})->middleware(HasRole::class.':noRole');

Route::get('/hasAnyRole', function () {
    return response(null,200);
})->middleware(HasAnyRole::class.':noRole,noAnotherRole');

//any passes
Route::get('/hasAnyRole', function () {
    return response(null,200);
})->middleware(HasAnyRole::class.':role,noAnotherRole');

Route::get('/hasAnyPermission', function () {
    return response(null,200);
})->middleware(HasAnyPermission::class.':permission,noAnotherPermission');