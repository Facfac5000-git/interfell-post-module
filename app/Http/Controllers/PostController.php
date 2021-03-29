<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use GuzzleHttp\Client;

use App\Models\Post;

class PostController extends Controller
{
    public function getPage(){
        return Post::with('user')->orderBy('publication_date','desc')->paginate(10);
    }

    public function fetch(){
        $client = new Client();
        $response = $client->get('https://sq1-api-test.herokuapp.com/posts');
        $json_response = json_decode($response->getBody()->getContents());
        foreach($json_response->data as $post){
            Post::create([
                'title' => $post->title,
                'description' => $post->description,
                'publication_date' => $post->publication_date,
                'user_id' => 1
            ]);
        }
    }
}
