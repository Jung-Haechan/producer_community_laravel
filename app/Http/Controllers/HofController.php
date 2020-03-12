<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hof;
use App\Mail;

class HofController extends Controller
{
    public function store(Request $req) {
        // 명예의 전당 테이블에 form 입력 값 저장
        HOF::create([
            'title' => $req->input('title'),
            'description' => $req->input('description'),
            'composer' => $req->input('composer'),
            'lyricist' => $req->input('lyricist'),
            'performer' => $req->input('performer'),
            'file_name' => $req->input('file_name')
        ]);
        // 메일 내용 변경
        Mail::find($req->input('mail_id'))->update([
            'content' => '귀하의 작품이 명예의 전당에 헌액되었습니다!',
            'hall_of_fame' => 0
        ]);
        return redirect(route('hof.index'));
    }

    public function index()
    {
        // 명예의전당 index
        $hofs = HOF::orderBy('id', 'desc')->paginate(7);
        return view('hof', [
            'hofs' => $hofs
        ]);
    }

    public function destroy(Hof $hof) {
        // 명예의전당 글 삭제
        HOF::find($hof['id'])->delete();
        return redirect(route('hof.index'));
    }
}
