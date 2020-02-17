<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;
use Config;

class PostsController extends Controller
{
    public function index()
    {   
        $board = $_GET['board'];
        $posts = POST::where('board', $board)->orderBy('id', 'desc')->get();
        return view('post/index', [
            'posts' => $posts,
            'board' => $board
        ]);
    }

    public function create()
    {
        return view('post/create');
    }

    public function store(Request $request)
    {   
        $board = $request->input('board');
        POST::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'author' => Auth::user()->name,
            'board' => $request->input('board'),
            'file' => $request->input('file')
        ]);
        return redirect(route('post.index').'?board='.$board);
    }

    public function show(Post $post)
    {
        return view('post/show', [
            'board' => $_GET['board'],
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('post/edit', [
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        POST::where('id', $post['id'])->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'file' => $request->input('file')
        ]);
        return redirect(route('post.show', $post['id']).'?board='.$post['board']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        POST::where('id', $post['id'])->delete();
        return redirect(route('post.index').'?board='.$post['board']);
    }
}
