<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Reply;
use Auth;
use Config;
use Storage;

class PostsController extends Controller
{
    public function __construct() {
        $this -> middleware('auth', ['except' => ['index', 'show']]);
    }
    public function index()
    {   
        $board = $_GET['board'];
        $posts = POST::where('board', $board)->orderBy('id', 'desc')->paginate(15);
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
            'file' => $request->file->store('public'),
            'file_type' => explode('/', $request->file->getMimeType())[0]
        ]);
        return redirect(route('post.index').'?board='.$board);
    }

    public function show(Post $post)
    {
        POST::where('id', $post['id'])->update([
            'views_number' => $post['views_number'] + 1
        ]);
        $file = Storage::url($post['file']);
        $replies = REPLY::where('post_id', $post['id'])->latest()->get();
        $post_next = POST::where('board', $post['board'])->where('id', '>', $post['id'])->limit(1)->get();
        $post_previous = POST::where('board', $post['board'])->where('id', '<', $post['id'])->limit(1)->orderBy('id', 'desc')->get();
        return view('post/show', [
            'board' => $_GET['board'],
            'post' => $post,
            'post_next' => $post_next,
            'post_previous' => $post_previous,
            'replies' => $replies,
            'file' => $file
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
        if(Auth::user()->name === $post['author']) {
            return view('post/edit', [
                'post' => $post
            ]);
        }
        else {
            return redirect(route('post.show', $post['id'])."?board=".$post['board']);
        }
        
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
