<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function test()
    {
        $posts = Post::create([
            'title' => "test title",
            'text' => "test text",
        ]);

        $tag1 = Tag::create(['name' => 'sport']);
        $tag2 = Tag::create(['name' => 'news']);

        $posts->tags()->attach([$tag1->id, $tag2->id]);

        $post = Post::query()->find(22);
        $tags = $post->tags;

        $tag = Tag::query()->find(2);
        $posts = $tag->posts;

    }

    public function index()
    {

        return PostResource::collection(Post::with('category')->get());

 /*       $response = [
            'success' => true,
            'message' => 'List all posts',
            'data' => $posts,
        ];

        return response()->json($response, 200);*/


    }

    public function show($id) {
        $post = Post::findOrFail($id);

        return (new PostResource($post))->additional([
            'success' => true,
            'message' => 'Posts retrieved successfully'
        ]);
    }
}
