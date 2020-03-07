@extends('layouts/app')
@section('css')
    <style>
        .list-striped li:nth-child(2n-1) {
            background: #eee;
        }
    </style>
@endsection

@section('content')
        <h2><a href="{{route('mypage')}}" class="text-dark">마이페이지</a></h2>
            <div class="row">
                <div class="col-lg-6">
                    <ul class="list-group list-striped" style="font-size: 13px">
                        <li class="list-group-item bg-dark text-light h6 m-0" >내가 쓴 게시글</li>
                        @foreach($myposts as $mypost)
                            <li class="list-group-item p-2"  style="border:0">
                                <a href="{{route('post.show', $mypost['id'])}}?board={{$mypost['board']}}" class="text-dark">
                                <span class="text-primary">[{{config('objects.board')[$mypost['board']]}}]</span>
                                {{$mypost['title']}}</a>
                            </li>
                        @endforeach
                    </ul>
                    @if($myposts)
                        <div class="mx-auto mt-4">
                            {{ $myposts->appends(['mypost' => $myposts])->links() }}
                        </div>
                    @endif
                </div>
                <div class="col-lg-6">
                    <ul class="list-group list-striped" style="font-size: 13px">
                        <li class="list-group-item bg-dark text-light h6 m-0" >내정보</li>
                        <li class="list-group-item p-2" style="border:0">이름: <strong>{{Auth::user()->name}}</strong></li>
                        <li class="list-group-item p-2" style="border:0">이메일: <strong>{{Auth::user()->email}}</strong></li>
                        <li class="list-group-item p-2" style="border:0"><a href="#" class="text-dark">비밀번호 변경하기</a></li>
                        <li class="list-group-item p-2" style="border:0">
                            <div class="row">
                                <div class="col-4">
                                    내 게시글 수:
                                </div>
                                <div class="col-8">
                                    @foreach($myposts_num as $key => $value)
                                        <div><strong>{{config('objects.board')[$key]}}게시판(<span class="text-danger">{{$value}}</span>)</strong></div>
                                    @endforeach
                                </div> 
                            </div>
                        </li>
                    </ul>
                </div>
            </div>      
@endsection