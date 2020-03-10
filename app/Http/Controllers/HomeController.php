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
        $posts = [];
        foreach(config('objects.board') as $key => $value) {
            $posts[$key] = POST::where('board', $key)->orderBy('id', 'DESC')->limit(6)->get();
        }
        $hofs = HOF::orderBy('id', 'desc')->limit(8)->get();
        $hofs_files = [];
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
        $myposts = POST::where('author', Auth::user()->name)->latest()->paginate(10);
        $myposts_num = array();
        foreach(config('objects.board') as $key => $value) {
            $myposts_num[$key] = POST::where('author', Auth::user()->name)->where('board', $key)->count();               
        }
        return view('mypage', [
            'myposts' => $myposts,
            'myposts_num' => $myposts_num
        ]);
    }
    public function introduce()
    {
        return view('introduce');    
    }
}
