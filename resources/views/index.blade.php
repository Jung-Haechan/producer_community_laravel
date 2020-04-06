@extends('layouts/app')

@section('css')
    <style>
        .list-striped li:nth-child(2n-1) {
            background: #eee;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            @foreach(config('objects.board') as $board => $board_korean)
                <ul class="list-group list-striped col-md-6 mb-3" style="font-size: 13px">
                    <li class="list-group-item bg-dark text-white h6 m-0">
                        {{$board_korean}}게시판
                        <span style="float:right"><a href="{{route('post.index')}}?board={{$board}}" class="text-white">+</a></span>
                    </li>
                    @foreach($posts[$board] as $post)
                        <li class="list-group-item p-2 px-4" style="border:0">
                            <a href="{{route('post.show', $post['id'])}}" class="text-dark">{{$post['title']}}</a>
                            @if($post['replies_number'])
                                <span class="text-danger">[{{$post['replies_number']}}]</span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endforeach
            <ul class="col-md-6 list-group">
                <li class="list-group-item h6 bg-dark m-0 text-white">
                    명예의전당
                    <span style="float:right"><a href="{{route('hof.index')}}" class="text-white">+</a></span>
                </li>
                <hof :hofs="{{$hofs}}"></hof>
            </ul>
        </div>
    </div>
@endsection
