<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function addLike(string $id)
    {
        $post = Post::find($id);

        if ($post) {
            $post->increment('likes');

            return response()->json([
                'success' => true,
                'message' => 'Лайк успешно поставлен',
                'likes' => $post->likes
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Пост не найден',
        ], 404);
    }

    public function index()
    {
        //$posts = $posts->getPosts();
        //$posts = DB::table('posts')->get();
        $posts = Post::orderBy('likes', 'desc')->paginate(10);

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
