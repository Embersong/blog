<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
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
