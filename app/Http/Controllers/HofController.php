<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hof;
use App\Mail;

class HofController extends Controller
{
    public function store(Request $req) {
        HOF::create([
            'title' => $req->input('title'),
            'description' => $req->input('description'),
            'composer' => $req->input('composer'),
            'lyricist' => $req->input('lyricist'),
            'performer' => $req->input('performer'),
            'file_name' => $req->input('file_name')
        ]);
        Mail::find($req->input('mail_id'))->update([
            'content' => '귀하의 작품이 명예의 전당에 헌액되었습니다!',
            'hall_of_fame' => 0
        ]);
        return redirect(route('post.index').'?board=composer_board');
    }

    public function index()
    {
        $hofs = HOF::orderBy('id', 'desc')->paginate(7);
        return view('hof', [
            'hofs' => $hofs
        ]);
    }
}
