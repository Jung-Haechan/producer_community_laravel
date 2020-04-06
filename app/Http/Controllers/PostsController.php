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
        $this->middleware('auth',
            ['except' => ['index', 'show', 'search']]
        );
    }

    public function index()
    {
        // 게시판에 따라 구별해서 데이터 출력
        $board = $_GET['board'];
        $posts = POST::getlist($board)->paginate(15);
        $data = [
            'posts' => $posts,
            'board' => $board,
        ];
        return view('post/index', $data);
    }

    public function create()
    {
        // 글쓰기
        return view('post/create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:80',
            'content' => 'required',
            'board' => 'required'
        ]);
        $data['author'] =  Auth::user()->name;
        // 파일 있을 때 게시글 저장
        if($request->file) {
            $data['file'] = $request->file->store('public');
            $data['file_type'] = explode('/', $request->file->getMimeType())[0];
        }
        POST::create($data);
        return redirect(route('post.index').'?board='.$data['board']);
    }

    public function show(Post $post)
    {
        // 조회수 증가
        POST::where('id', $post['id'])->update([
            'views_number' => $post['views_number'] + 1
        ]);
        $data = [
            'post' => $post,
            'post_next' => POST::getNeighbor($post, '>')->get(),
            'post_previous' => POST::getNeighbor($post, '<')->orderBy('id', 'desc')->get(),
            'replies' => REPLY::where('post_id', $post['id'])->get(),
            'file' => Storage::url($post['file']),
        ];
        return view('post/show', $data);
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
            return redirect(route('post.show', $post['id']));
        }

    }

    public function update(Request $request, Post $post)
    {
        // 파일 있을 때 게시글 수정
        $data = $request->validate([
            'title' => 'required|max:80',
            'content' => 'required',
        ]);
        if($request->file) {
            $data['file'] = $request->file->store('public');
            $data['file_type'] = explode('/', $request->file->getMimeType())[0];
        }
        // 파일 없을 때 게시글 수정
        POST::where('id', $post['id'])->update($data);
        return redirect(route('post.show', $post['id']));
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
            $posts = POST::where(['board','like', '%'.$board])
                ->where('title', 'like', '%'.$value.'%')
                ->orWhere('content', 'like', '%'.$value.'%')
                ->orderBy('id', 'desc')
                ->paginate(15);
        }
        // 범위가 제목, 또는 글쓴이일 때
        else {
            $posts = POST::where('board','like', '%'.$board)
                ->where($range, 'like', '%'.$value.'%')
                ->orderBy('id', 'desc')
                ->paginate(15);
        }
        return view('post/search',[
            'posts' => $posts,
            'value' => $value,
            'range' => $range,
            'board' => $board
        ]);
    }
}
