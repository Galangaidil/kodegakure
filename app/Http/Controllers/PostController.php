<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): \Illuminate\Http\Response
    {
        $res = [
            'status' => true,
            'data' => Post::latest()->get(),
            'message' => 'enjoy the meat'
        ];
        return response($res, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): \Illuminate\Http\Response
    {
        $request->validate([
            'filename' => ['required', 'image'],
            'description' => ['string']
        ]);

        $file = $request->file('filename');
        $filename = $file->hashName();
        $file->storeAs('public/images', $filename);

        $post = Post::create([
            'slug' => Str::random(7),
            'filename' => $filename,
            'description' => $request->input('description')
        ]);

        $res = [
            'status' => true,
            'data' => $post,
            'message' => 'post created successfully'
        ];

        return response($res, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'description' => ['required', 'string']
        ]);

        $post->update($request->only('description'));

        $res = [
            'status' => true,
            'data' => $post,
            'message' => 'post updated successfully'
        ];

        return response($res, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
//        $post->delete();
        Storage::delete('public/images/'.$post->filename);
        return $post->delete();
    }
}
