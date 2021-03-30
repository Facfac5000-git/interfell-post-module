<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;


Route::get('/', [PageController::class, 'index'])
    ->name('index');

Route::get('dashboard', [PageController::class, 'dashboard'])
    ->middleware('auth:sanctum')
    ->name('dashboard');

Route::get('index', [PageController::class, 'userArea'])
    ->middleware('auth:sanctum')
    ->name('index');

Route::get('posts', [PostController::class, 'getPage']);

Route::get('posts/create', [PostController::class, 'create'])
    ->name('posts.create');

Route::post('posts', [PostController::class, 'store'])
    ->name('posts.store');

Route::get('posts/show/{post_id}', [PostController::class, 'show'])
    ->name('posts.show');

Route::get('posts/{user_id}', [PostController::class, 'getPagebyUser']);

Route::get('fetch', [PostController::class, 'fetch']);
