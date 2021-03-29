<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use Inertia\Inertia;
use App\Models\Post;

class PageController extends Controller
{
    public function dashboard() {
        return Inertia::render('Dashboard');
    }

    public function index() {

        //dd(gettype(Post::with('user')->orderBy('publication_date','desc')->paginate(10)));

        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
        ]);
    }
}
