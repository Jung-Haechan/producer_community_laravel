<?php

namespace App\Http\Controllers;

use App\Qna;
use Illuminate\Http\Request;

class QnaController extends Controller
{
    public function index()
    {
        // Q&A index
        $qnas = QNA::paginate(10);
        return view('qna/index', [
            'qnas' => $qnas
        ]);
    }

    public function create() {
        // 질문 페이지
        return view('qna/create');
    }
    public function store(Request $req)
    {
        // Q&A 질문 저장
        QNA::create([
            'title' => $req -> input('title'),
            'question' => $req -> input('question')
        ]);
        return redirect(route('qna.index'));
    }

    public function show(Qna $qna)
    {
        // 질문 보여주기
        return view('qna/show', [
            'qna' => $qna
        ]);
    }

    public function update(Qna $qna, Request $req) {
        // 답변 저장
        QNA::find($qna['id'])->update([
            'answer' => $req->input('answer')
        ]);
        return redirect(route('qna.show', $qna['id'])); 
    }

    public function destroy(Qna $qna)
    {
        // 질문 삭제
        QNA::find($qna['id'])->delete();
        return redirect(route('qna.index'));
    }
}
