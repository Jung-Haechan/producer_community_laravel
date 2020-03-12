<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Config;

class BestController extends Controller
{
    public function index() {
        $best_posts = [];
        $board = $_GET['board'];
        // 각 게시판을 배열에 담아 숫자로 표현하고, 각 게시판 배열에 게시글 배열을 담는다.  
        $i=0;
        foreach(config('objects.board') as $key => $value) {
            $best_posts[$i] = POST::where('board', $key)->orderBy('like_number', 'DESC')->limit(10)->get();
            $best_posts_korean[$i] = $value;
            $i=$i+1;
        }    
        return response()->json([
            'board' => $board,
            'best_posts' => $best_posts,
            'best_posts_korean' => $best_posts_korean 
        ]) ;
    }
}
