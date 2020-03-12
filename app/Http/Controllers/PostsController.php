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
        $this -> middleware('auth', ['except' => ['index', 'show', 'search']]);
    }

    public function index()
    {   
        // 게시판에 따라 구별해서 데이터 출력
        $board = $_GET['board'];
        $posts = POST::where('board', $board)->orderBy('id', 'desc')->paginate(15);
        return view('post/index', [
            'posts' => $posts,
            'board' => $board
        ]);
    }

    public function create()
    {
        // 글쓰기
        return view('post/create');
    }

    public function store(Request $request)
    {   
        $board = $request->input('board');
        // 파일 있을 때 게시글 저장
        if($request->file) {
            POST::create([
                'title' => $request->input('title'),
                'content' => $request->input('content'),
                'author' => Auth::user()->name,
                'board' => $request->input('board'),
                'file' => $request->file->store('public'),
                'file_type' => explode('/', $request->file->getMimeType())[0]
            ]);
        }
        //파일 없을 때 게시글 저장
        else {
            POST::create([
                'title' => $request->input('title'),
                'content' => $request->input('content'),
                'author' => Auth::user()->name,
                'board' => $request->input('board')
            ]);
        }
        return redirect(route('post.index').'?board='.$board);
    }

    public function show(Post $post)
    {
        // 조회수 증가
        POST::where('id', $post['id'])->update([
            'views_number' => $post['views_number'] + 1
        ]);
        // 파일 불러오기 
        $file = Storage::url($post['file']);
        // 댓글 불러오기
        $replies = REPLY::where('post_id', $post['id'])->get();
        // 이전글, 다음글 불러오기
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

    public function edit(Post $post)
    {
        // 작성자가 본인이면 수정 페이지 보여줌
        if(Auth::user()->name === $post['author']) {
            return view('post/edit', [
                'post' => $post
            ]);
        }
        // 아니면 해당 게시글 보여줌
        else {
            return redirect(route('post.show', $post['id'])."?board=".$post['board']);
        }
        
    }

    public function update(Request $request, Post $post)
    {
        // 파일 있을 때 게시글 수정
        if($request->file) {
            POST::where('id', $post['id'])->update([
                'title' => $request->input('title'),
                'content' => $request->input('content'),
                'file' => $request->file->store('public'),
                'file_type' => explode('/', $request->file->getMimeType())[0]
            ]);
        }
        // 파일 없을 때 게시글 수정
        else {
            POST::where('id', $post['id'])->update([
                'title' => $request->input('title'),
                'content' => $request->input('content')
            ]);
        }
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
        // 게시글 삭제
        POST::where('id', $post['id'])->delete();
        return redirect(route('post.index').'?board='.$post['board']);
    }

    public function search(Request $request)
    {   
        $value = $request -> input('value'); // 검색어
        $range = $request -> input('range'); // 범위
        $board = $request -> input('board'); // 게시판
        // 범위가 제목+내용일 때 
        if($range==='title_content') {
            $posts = POST::where('board','like', '%'.$board)->where('title', 'like', '%'.$value.'%')->orWhere('content', 'like', '%'.$value.'%')->orderBy('id', 'desc')->paginate(15);
        }
        // 범위가 제목, 또는 글쓴이일 때
        else {
            $posts = POST::where('board','like', '%'.$board)->where($range, 'like', '%'.$value.'%')->orderBy('id', 'desc')->paginate(15);
        }
        return view('post/search',[
            'posts' => $posts,
            'value' => $value,
            'range' => $range,
            'board' => $board
        ]);
    }
}
