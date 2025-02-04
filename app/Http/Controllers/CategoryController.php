<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index() {
        $categories = Category::all();

        return view('categories.index', compact('categories'));
    }

    public function show(Category $category)     {
      //  $category = Category::query()->findOrFail($id);

       // $posts = Post::where('category_id', $category->id)->get();

      //  $category = Category::query()->with('posts')->find($id);


       return view('categories.show', [
           'category' => $category
       ]);
    }
}
