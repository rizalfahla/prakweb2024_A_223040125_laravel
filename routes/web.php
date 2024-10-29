<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('home',['tittle' => 'Home Page']);
});

Route::get('/about', function () {
    return view('about',['name' => 'Fahla', 'tittle' => 'About'] );
});

Route::get('/posts', function () {

    return view('posts',  ['title' => 'Blog', 'posts' => Post::filter(request(['search', 'category', 'author']))->latest()->paginate(9)->withQueryString()]);
});


Route::get('/posts/{post:slug}', function (Post $post){
    return view('post', ['tittle' => 'Single Post', 'post' => $post]);
});

Route::get('/authors/{user:username}', function (User $user){
    return view('posts', ['tittle' => count($user->posts) . ' Article by ' . $user->name, 'posts' => $user -> posts]);
});

Route::get('/categories/{category:slug}', function (Category $category){
    return view('posts', ['tittle' =>  'Article in ' . $category->name, 'posts' => $category -> posts]);
});


Route::get('/contact', function () {
    return view('contact',['tittle' => 'Contact'] );
});

