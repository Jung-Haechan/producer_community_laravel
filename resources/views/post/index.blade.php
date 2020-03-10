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
        .table td:nth-child(6) {
            width: 10%;
            text-align: center;
        }
        .desktop-hide {
            display:none;
        }
    @media(max-width: 992px) {
        .desktop-hide {
            display: inherit;
        }
        .mobile-hide {
            display: none;
        }
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
                    <td class="mobile-hide">번호</td>
                    <td>제목</td>
                    <td class="mobile-hide">글쓴이</td>
                    <td class="mobile-hide">날짜</td>
                    <td class="mobile-hide">조회수</td>
                    <td class="mobile-hide">추천수</td>
                </tr>
            </thead>
            <tbody>
            @foreach($posts as $post)
                <tr>
                    <td class="mobile-hide">{{$post['id']}}</td>
                    <td>
                        <div>
                            <a href="{{route('post.show', $post['id'])}}?board={{$board}}" class="text-dark">
                                {{$post['title']}}
                                @if($post['replies_number'])
                                    <span class="text-danger">[{{$post['replies_number']}}]</span>
                                @endif
                            </a>
                        </div>
                        <div class="desktop-hide" style="font-size: 11px;">
                            <span class="desktop-hide pr-3">글쓴이:&nbsp{{$post['author']}}</span>
                            <span class="desktop-hide pr-3">날짜:&nbsp{{explode(' ', $post['created_at'])[0]}}</span>
                            <span class="desktop-hide pr-3">조회수:&nbsp{{$post['views_number']}}</span>
                            <span class="desktop-hide pr-3">추천수:&nbsp{{$post['like_number']}}</span>
                        </div>
                    </td>
                    <td class="mobile-hide">{{$post['author']}}</td>
                    <td class="mobile-hide">{{explode(' ', $post['created_at'])[0]}}</td>
                    <td class="mobile-hide">{{$post['views_number']}}</td>
                    <td class="mobile-hide">{{$post['like_number']}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="row">
        @if($posts)
            <div class="col-8">
                {{ $posts->appends(['board' => $board])->links() }}
            </div>
        @endif
            <div class="col-4">
                <button class="btn btn-dark" data-target="#search" data-toggle="modal" style="float:right">검색</button>
            </div>
        </div>
        @component('search_modal', [
            'board' => $board
            ])
        @endcomponent

@endsection