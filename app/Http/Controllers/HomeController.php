<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Hof;
use Storage;
use Auth;
use Congig;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['only' => 'mypage']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // 각 게시판 별로 최신 게시글 가져오기
        $posts = [];
        foreach(config('objects.board') as $key => $value) {
            $posts[$key] = POST::where('board', $key)->orderBy('id', 'DESC')->limit(6)->get();
        }
        $hofs = HOF::orderBy('id', 'desc')->limit(8)->get();
        // 명예의전당 게시글을 배열에 담아 숫자로 표시
        // (좌우로 넘길 때 알고리즘을 쉽게 하기 위함)
        $hof_files = [];
        $i = 0;
        foreach($hofs as $hof) {
            $hof_files[$i] = Storage::url($hof['file_name']);
            $i++;
        }
        return view('index', [
            'posts' => $posts,
            'hofs' => $hofs,
            'hof_files' => $hof_files
        ]);
    }

    public function mypage()
    {
        // 내가 쓴 게시글 가져오기
        $myposts = POST::getMyList()->paginate(10);
        // 내가 쓴 게시글 수 가져오기
        $myposts_num = array();
        foreach(config('objects.board') as $key => $value) {
            $myposts_num[$key] = POST::countMyList($key);
        }
        return view('mypage', [
            'myposts' => $myposts,
            'myposts_num' => $myposts_num
        ]);
    }

    public function introduce()
    {
        //커뮤니티 소개
        return view('introduce');
    }
}
