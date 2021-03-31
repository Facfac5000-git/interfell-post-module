<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;


Route::get('/', [PageController::class, 'index'])
    ->name('welcome');

Route::get('dashboard', [PageController::class, 'dashboard'])
    ->middleware('auth:sanctum')
    ->name('dashboard');

Route::get('index', [PageController::class, 'userArea'])
    ->middleware('auth:sanctum')
    ->name('index');

Route::get('posts', [PostController::class, 'getPage']);

Route::get('posts/create', [PostController::class, 'create'])
    ->middleware('auth:sanctum')
    ->name('posts.create');

Route::post('posts', [PostController::class, 'store'])
    ->middleware('auth:sanctum')
    ->name('posts.store');

Route::get('posts/show/{post_id}', [PostController::class, 'show'])
    ->middleware('auth:sanctum')
    ->name('posts.show');

Route::get('posts/{user_id}', [PostController::class, 'getPagebyUser'])
    ->middleware('auth:sanctum');

Route::get('fetch', [PostController::class, 'fetch']);
