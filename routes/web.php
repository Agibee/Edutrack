<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware;
use App\Http\Controllers\Auth\AuthController;


Route::get('/', function () {
    return view('welcome');
});
