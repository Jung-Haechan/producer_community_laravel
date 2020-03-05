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
