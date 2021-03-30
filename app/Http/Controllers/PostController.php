<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use GuzzleHttp\Client;

use App\Models\Post;
use Inertia\Inertia;

class PostController extends Controller
{
    public function create(){

    }

    public function store(Request $request){

    }

    public function show($post_id){
        $post = Post::find($post_id);
        return Inertia::render('Posts/Show', ['post' => $post]);
    }

    public function getPage(){
        return Post::with('user')
            ->orderBy('publication_date','desc')
            ->paginate(10);
    }

    public function getPagebyUser($user_id){
        return Post::with('user')
            ->where('user_id', $user_id)
            ->orderBy('publication_date','desc')
            ->paginate(10);
    }

    public function fetch(){
        $client = new Client();
        $response = $client->get('https://sq1-api-test.herokuapp.com/posts');
        $json_response = json_decode($response->getBody()->getContents());
        foreach($json_response->data as $post){
            $new_post = Post::create([
                'title' => $post->title,
                'description' => $post->description,
                'publication_date' => $post->publication_date,
                'user_id' => 1
            ]);
            echo $new_post.'<br>';
        }
    }
}
