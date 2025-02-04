<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
    {
        //$posts = $posts->getPosts();
        //$posts = DB::table('posts')->get();
        $posts = Post::paginate(10);

        return view('posts.index', [
            'posts' => $posts,
        ]);
    }

    public function show(Post $post)
    {

      //  $post = DB::table('posts')->find($id);

    //$post = Post::query()->where('id', $id)->first();
        //$post = Post::query()->find($id);
      //  $post = Post::findOrFail($id);

        return view('posts.show', [
            'post' => $post,
        ]);
    }
}
