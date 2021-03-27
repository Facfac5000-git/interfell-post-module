<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

class PostController extends Controller
{
    public function getPage(){
        return Post::with('user')->orderBy('publication_date','desc')->paginate(10);
    }
}
