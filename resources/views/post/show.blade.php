@extends('layouts/app')
@section('css')
    <style>

    </style>
@endsection

@section('content')
        <h2><a href="{{route('post.index')}}?board={{$board}}" class="text-dark">{{config('objects.board')[$board]}}게시판</a></h2>
        <div class='container bg-white' style="border-radius:20px">
            <div class='p-3'><strong>제목: {{$post['title']}}</strong></div>
            <div class='row bg-dark text-light p-2 ' style="font-size:12px;">
                <div class='col-4'>By <strong>{{$post['author']}}</strong></div>
                <div class='col-4'>{{$post['created_at']}}</div>
                <div class='col-4'>조회수: {{$post['views_number']}}</div>
            </div>
            <div class='p-3' style="min-height: 300px">
                <div class="pb-3">{{$post['content']}}</div>
            @if($post['file_type']==='audio')
                <div class="mb-4 mx-auto" style="width:300px">
                    <audio controls>
                        <source src="{{$file}}">
                    </audio>
                </div>
            @elseif($post['file_type']==='image')
                <div class="mx-auto col-12 col-md-8">
                    <img src="{{$file}}" alt="이미지" class="img-responsive mx-auto" style="width:100%">
                </div>               
            @endif
            </div>
                
            @if(isset(Auth::user()->name) && Auth::user()->name===$post['author'])
            <div class="row">
                <form action="{{route('post.destroy',$post['id'])}}" method='post'>
                    <div class="form-group">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-sm btn-dark ml-4" type='submit'>삭제</button>
                    </div>                    
                </form>
                <form action="{{route('post.edit', $post['id'])}}" method='get'>
                    <div class="form-group">
                        <button class="btn btn-sm btn-dark ml-3" type='submit'>수정</button>
                    </div>    
                </form>
            </div>
            @endif
            <div>
                <div class='row bg-dark p-2 pl-3 text-light' style="border:1px solid #eee">다음글:&nbsp&nbsp
                    @foreach($post_next as $post_next_)
                        <a href="{{route('post.show', $post_next_['id'])}}?board={{$board}}" class="text-light"><strong>{{$post_next_['title']}}</strong></a>
                    @endforeach
                </div>
                <div class='row bg-dark p-2 pl-3 text-light'>이전글:&nbsp&nbsp
                    @foreach($post_previous as $post_previous_)
                        <a href="{{route('post.show', $post_previous_['id'])}}?board={{$board}}" class="text-light"><strong>{{$post_previous_['title']}}</strong></a>
                    @endforeach
                </div>
            </div>
            <form action="{{route('reply.store')}}" class="form-horizontal" method='post'>
                @csrf
                <div class="form-group py-3 pb-5">
                    <label for="reply">댓글:</label>
                    <textarea name='content' id="reply" rows='5' class="form-control" required></textarea>
                    <button class="btn btn-dark mt-2" type='submit' style="float:right">댓글</button>
                    <input type='hidden' name='board' value='composer_board'>
                    <input type='hidden' name='post_id' value="{{$post['id']}}">
                </div><hr>
            </form>
            <div class='replies'>
                @foreach($replies as $reply)
                    <div>
                        <i class="pl-2"><strong>{{$reply['author']}}</strong> 님의 댓글</i>
                        @if(isset(Auth::user()->name) && Auth::user()->name===$reply['author'])
                            <form action="{{route('reply.destroy', $reply['id'])}}" method="post" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="reply_id" value="{{$reply['id']}}">
                                <button type="submit" class="btn btn-sm btn-dark ml-3">삭제</button>
                            </form>
                        @endif
                        <div class="p-2 mt-2" style="background:#ddd">{{$reply['content']}}
                            <div class="text-right" style="font-size:13px;">{{$reply['created_at']}}</div>
                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
@endsection