<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostDetailResource;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    //
    public function index()
    {
        $posts = Post::all();
        // return response()->json(['data' => $posts]);
        return PostResource::collection($posts);
    }

    public function show($id)
    {
        $post = Post::with('writer:id,username')->findOrFail($id);
        return new PostDetailResource($post);
    }

    public function show2($id)
    {
        $post = Post::findOrFail($id);
        return new PostDetailResource($post);
    }

    public function store(Request $request)
    {
        // dd(Auth::user()->id);
        $validated = $request->validate([
        'title' => 'required|max:255',
        'news_content' => 'required'
    ]);


    $request['author'] = Auth::user()->id;
    $post = Post::create($request->all());
    return new PostDetailResource($post->loadMissing('writer:id,username'));

        // return response()->json('oke bisa di akses method store');
    }
}
