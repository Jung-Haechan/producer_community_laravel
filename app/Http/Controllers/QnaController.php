<?php

namespace App\Http\Controllers;

use App\Qna;
use Illuminate\Http\Request;

class QnaController extends Controller
{
    public function index()
    {
        $qnas = QNA::paginate(10);
        return view('qna/index', [
            'qnas' => $qnas
        ]);
    }
    public function create() {
        return view('qna/create');
    }
    public function store(Request $req)
    {
        QNA::create([
            'title' => $req -> input('title'),
            'question' => $req -> input('question')
        ]);
        return redirect(route('qna.index'));
    }

    public function show(Qna $qna)
    {
        return view('qna/show', [
            'qna' => $qna
        ]);
    }
    public function update(Qna $qna, Request $req) {
        QNA::find($qna['id'])->update([
            'answer' => $req->input('answer')
        ]); 
    }
    public function destroy(Qna $qna)
    {
        //
    }
}
