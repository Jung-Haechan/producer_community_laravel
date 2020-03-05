@extends('layouts/app')

@section('content')
    <div class="row">
        <h2 class="col-7"><a href="{{route('qna.index')}}" class="text-dark">Q&A</a></h2>
        <div class="col-5">
        <a href="{{route('qna.create')}}" class="btn btn-dark" style="float:right">질문하기</a>
        </div>
    </div>
    <div class="container bg-white mt-4">
        @foreach($qnas as $qna)
            <div class="row p-3 border-bottom">
                <div class="col-md-8 pt-2 pt-md-0">
                <h6><a class="text-dark" href="{{route('qna.show', $qna['id'])}}">Q. {{$qna['title']}}</a></h6>
                </div>
                <div class="col-4 text-right">
                    @if($qna['answer'])
                        <span class="text-success">답 달림</span>
                    @else
                        <span class="text-danger">답 대기중</span>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
    @if($qnas)
        <div class="col-10">
            {{ $qnas->links() }}
        </div>
    @endif
@endsection