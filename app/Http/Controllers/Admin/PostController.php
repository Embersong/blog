<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{

    //TODO добавьте пагинацию
    public function index()
    {
        $posts = Post::all();

        return view('admin.posts.index', [
            'posts' => $posts
        ]);
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.posts.create', [
            'categories' => $categories
        ]);
    }

    public function edit(Post $post)
    {

        $categories = Category::all();

        return view('admin.posts.edit', [
            'categories' => $categories,
            'post' => $post,
        ]);
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|min:5|max:255',
            'text' => 'required|min:5|max:20000',
            'category_id' => 'required|exists:categories,id',
        ]);

        $post->fill($validated);

        if ($post->save()) {
            return redirect()->route('posts.show', $post)->with('success', 'Пост успешно изменен!');
        }
        return back()->with('error', 'Ошибка изменения поста');
    }

    public function store(Request $request)
    {

        //валидация данных
        $validated = $request->validate([
            'title' => 'required|min:5|max:255',
            'text' => 'required|min:5|max:20000',
            'category_id' => 'required|exists:categories,id',
        ]);

        try {
            $post = Post::create($validated);
        } catch (\Exception $e) {
            return redirect()->route('admin.posts.create')->with('error', 'Ошибка добавления поста! ' . $e->getMessage());
        }

        //DB::table('posts')->insert($validated);
        //$id = DB::getPdo()->lastInsertId();


        return redirect()->route('posts.show', $post->id)->with('success', 'Пост успешно добавлен');
    }
}
