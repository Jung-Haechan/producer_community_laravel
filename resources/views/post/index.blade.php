@extends('layouts/app')
@section('css')
    <style>
        .table td:nth-child(1) {
            width: 5%;
        }
        .table td:nth-child(2) {
            width: 65%;
            white-space: normal;
        }
        .table td:nth-child(3) {
            width: 10%;
        }
        .table td:nth-child(4) {
            width: 10%;
        }
        .table td:nth-child(5) {
            width: 10%;
            text-align: center;
        }

        
    </style>
@endsection

@section('content')
        <div class="row mb-2">
            <h2 class="col-7"><a href="{{route('post.index')}}?board={{$board}}" class="text-dark">{{config('objects.board')[$board]}}게시판</a></h2>
            <form action="{{route('post.create')}}" method="get" class="col-5">
                <input type="hidden" name="board" value="{{$board}}">
                <button type="submit" class="btn btn-dark" style="float:right">글쓰기</button>
            </form>
        </div>
        <table class="table table-condensed table-striped" style="font-size:14px;">
            <thead class="bg-dark text-light">
                <tr>
                    <td>번호</td><td>제목</td><td>글쓴이</td><td>날짜</td><td>조회수</td>
                </tr>
            </thead>
            <tbody>
            @foreach($posts as $post)
                <tr>
                    <td>{{$post['id']}}</td>
                    <td><a href="{{route('post.show', $post['id'])}}?board={{$board}}" class="text-dark">{{$post['title']}}</a></td>
                    <td>{{$post['author']}}</td>
                    <td>{{explode(' ', $post['created_at'])[0]}}</td>
                    <td>{{$post['views_number']}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @if($posts)
            <div class="mx-auto mt-4" style="width:124px;">
                {{ $posts->appends(['board' => $board])->links() }}
            </div>
        @endif
@endsection