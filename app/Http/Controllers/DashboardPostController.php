<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /* return Post::where('author_id',auth()->user()->id)->get(); */
        return view('dashboard.posts.index',
            [
                'posts' => Post::where('author_id',auth()->user()->id)->get()
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.posts.create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts',
            'category_id' => 'required',
            'image' => 'image|file|max:1024',
            'body' => 'required'
        ]);

        if ($request->file('image')) {
            $validateData['image'] = $request->file('image')->store('post-images');
        }

        $validateData['author_id'] = auth()->user()->id;
        $validateData['body'] = Str::limit(strip_tags($request->body), 200);
        
        Post::create($validateData);

        return redirect('/dashboard/posts')->with('success', 'New post has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('dashboard.posts.show', [
        'post' => $post ]
    );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('dashboard.posts.edit', [
            'post' => $post,
            'categories' => Category::all()
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
{
    $rules = [
        'title' => 'required|max:255',
        'category_id' => 'required',
        'image' => 'image|file|max:1024',
        'body' => 'required',
    ];

    if ($request->slug != $post->slug) {
        $rules['slug'] = 'required|unique:posts';
    }

    $validatedData = $request->validate($rules);

    // Proses upload gambar baru dan hapus gambar lama jika ada
    if ($request->file('image')) {
        if ($request->oldImage) {
            Storage::delete($request->oldImage); // Hapus gambar lama
        }
        $validatedData['image'] = $request->file('image')->store('post-images');
    }

    $validatedData['author_id'] = Auth::id();
    $validatedData['body'] = strip_tags($request->body);
    $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200);

    $post->update($validatedData);

    return redirect('/dashboard/posts')->with('success', 'Post has been updated!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Post::destroy($post->id);

        if ($post->image) {
            Storage::delete($post->image);
        }

        return redirect('/dashboard/posts')->with('success', 'Post has been deleted!');
    
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug'=>$slug]);
    }
}
