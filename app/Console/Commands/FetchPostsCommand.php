<?php

namespace App\Console\Commands;

use App\Models\Post;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class FetchPostsCommand extends Command
{

    protected $signature = 'fetch:posts';


    protected $description = 'This commands allows the server to fetch the new posts from sq1-api-test.herokuapp.com';


    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
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
            echo $new_post."\n";
        }
    }
}
