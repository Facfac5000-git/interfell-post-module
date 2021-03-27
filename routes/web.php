<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;


Route::get('/', [PageController::class, 'index']);

Route::get('dashboard', [PageController::class, 'dashboard'])
    ->middleware('auth:sanctum')
    ->name('dashboard');

Route::resource('posts', PostController::class)
    ->middleware('auth:sanctum');

Route::get('posts', [PostController::class, 'getPage']);
