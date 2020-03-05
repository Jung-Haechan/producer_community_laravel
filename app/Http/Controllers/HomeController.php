<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
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
        $this->middleware('auth', ['except' => 'introduce']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
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
