<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use Inertia\Inertia;
use App\Models\Post;

class PageController extends Controller
{
    public function dashboard() {
        return Inertia::render('Dashboard');
    }

    public function index() {
        return Inertia::render('Posts/Welcome');
    }

    public function userArea() {
        return Inertia::render('Posts/Index', [
            'user' => Auth::user(),
        ]);
    }
}
