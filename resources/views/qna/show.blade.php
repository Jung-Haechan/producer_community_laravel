@extends('layouts/app')

@section('css')
<style>
    .balloon_01 {
        position:relative;
        margin-top: 40px;
        width:100%;
        background: white;
        border-radius: 10px;
        }
        .balloon_01:after {
        border-top:0px solid transparent;
        border-left: 10px solid transparent;
        border-right: 10px solid transparent;
        border-bottom: 10px solid white;
        content:"";
        position:absolute;
        top:-10px;
        left:50%;
        }
</style>
@endsection

@section('content')
    <div class="row">
        <h2 class="col-7"><a href="{{route('qna.index')}}" class="text-dark">Q&A</a></h2>
        <div class="col-5">
        <a href="{{route('qna.create')}}" class="btn btn-dark" style="float:right">질문하기</a>
        </div>
    </div>
    <div class="container bg-white mt-4" style="border-radius:6px">
        <div class="py-3 border-bottom"><strong>Q. {{$qna['title']}}</strong></div>
        <div class="py-3" style="min-height:200px">{{$qna['question']}}</div>
        <form action="{{route('qna.destroy', $qna['id'])}}" method="post">
            @csrf
            @method('DELETE')
            <button class="btn btn-dark mb-3">삭제</button>
        </form>
    </div>
    @if(!$qna['answer']&&isset(Auth::user()->name)&&Auth::user()->name==='운영자')
        <form action="{{route('qna.update', $qna['id'])}}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group mt-4">
                <textarea name="answer" id="answer" rows="5" class="form-control" placeholder="답변 작성하기"></textarea>
            </div>
            <button class="btn btn-dark" type="submit" style="float:right">답변하기</button>
        </form>
    @elseif($qna['answer'])
        <div class="balloon_01 p-3">A. {{$qna['answer']}}</div>
    @else
        <div class="text-danger text-right">답변 대기중입니다.</div>
    @endif
@endsection