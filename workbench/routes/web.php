<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hasPermission', function () {
    return response(null,200);
});

Route::get('/hasAnyPermission', function () {
    return response(null,200);
});

Route::get('/hasRole', function () {
    return response(null,200);
});

Route::get('/hasAnyRole', function () {
    return response(null,200);
});
