<?php

use App\Http\Controllers\Admin\IndexController as AdminIndexController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/vkontakte/redirect', function () {
    return Socialite::driver('vkontakte')->redirect();
});

Route::get('/vkontakte/callback', function () {
    $socialUser = Socialite::driver('vkontakte')->user();
    $user = User::query()->where('email', $socialUser->getEmail())->first();
    if(!$user) {
        $user = User::query()->create([
            'email' => $socialUser->getEmail(),
            'name' => $socialUser->getName(),
            'password' => 'password'
        ]);
    }
    Auth::login($user);
    return redirect('/');
});


Route::view('/', 'index')->name('home');

Route::get('/posts/{post}', [PostController::class, 'show'])->where('post', '[0-9]+')->name('posts.show');
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/categories/', [CategoryController::class, 'index'])->name('posts.categories.index');
Route::get('/posts/categories/{category}', [CategoryController::class, 'show'])->name('posts.categories.show');
Route::post('/posts/{id}/add/like', [PostController::class, 'addLike'])->name('posts.like.add');

Route::name('admin.')
    ->middleware(['auth', 'is_admin'])
    ->prefix('admin')
    ->group(function () {
        Route::get('/', [AdminIndexController::class, 'index'])->name('index');
        Route::get('/users', [AdminIndexController::class, 'posts'])->name('users');

        Route::resource('/posts', AdminPostController::class)->except('show');
        /*
        Route::name('posts.')
            ->prefix('posts')
            ->group(function () {

                Route::get('/', [AdminPostController::class, 'index'])->name('index');
                Route::get('/create', [AdminPostController::class, 'create'])->name('create');
                Route::post('/store', [AdminPostController::class, 'store'])->name('store');
                Route::get('/{post}/edit/', [AdminPostController::class, 'edit'])->name('edit');
                Route::put('/update/{post}', [AdminPostController::class, 'update'])->name('update');
                Route::delete('/destroy/{post}', [AdminPostController::class, 'destroy'])->name('destroy');

            });
*/

        Route::get('/categories', [AdminIndexController::class, 'categories'])->name('categories');
    });




Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
