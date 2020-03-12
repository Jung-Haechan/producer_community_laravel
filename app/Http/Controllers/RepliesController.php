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
        // 댓글 작성 시 게시글의 댓글 수 +1
        $post = POST::where('id', $_POST['post_id']);
        $post_get = $post->get(); 
        $post->update([
            'replies_number' => $post_get[0]['replies_number'] + 1
        ]);
        // 댓글 저장
        Reply::create([
            'content' => $request -> input('content'),
            'post_id' => $_POST['post_id'],
            'author' => Auth::user()->name
        ]);
        return redirect()->back();
    }

    public function destroy()
    {
        // 댓글 삭제 시 게시글의 댓글수 -1
        $post = POST::where('id', $_POST['post_id']);
        $post_get = $post->get(); 
        $post->update([
            'replies_number' => $post_get[0]['replies_number'] - 1
        ]);
        // 댓글 삭제
        REPLY::where('id', $_POST['reply_id'])->delete();
        return redirect()->back();
    }
}
