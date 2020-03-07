<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Post;
use Illuminate\Http\Request;
use Auth;

class RepliesController extends Controller
{
    public function __construct() {
        $this -> middleware('auth');
    }
    public function store(Request $request)
    {
        $post = POST::find($_POST['post_id']);
        $post->update([
            'replies_number' => $post['replies_number']+1
        ]);
        Reply::create([
            'content' => $request -> input('content'),
            'post_id' => $_POST['post_id'],
            'author' => Auth::user()->name
        ]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        REPLY::where('id', $_POST['reply_id'])->delete();
        return redirect()->back();
    }
}
