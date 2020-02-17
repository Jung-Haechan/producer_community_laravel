@extends('layouts/app')
@section('css')
    <style>

    </style>
@endsection

@section('content')
    <div class="container">
        <h2><a href="{{route('post.index')}}?board={{$board}}" class="text-dark">{{config('objects.board')[$board]}}게시판</a></h2>
        <div class='container bg-white' style="border-radius:20px">
            <div class='p-3'><strong>제목: {{$post['title']}}</strong></div>
            <div class='row bg-dark text-light p-2 ' style="font-size:12px;">
                <div class='col-4'>By <strong>{{$post['author']}}</strong></div>
                <div class='col-4'>{{$post['created_at']}}</div>
                <div class='col-4'>조회수: {{$post['views_number']}}</div>
            </div>
            <div class='p-3' style="min-height: 400px">{{$post['content']}}</div>
            <div class="row">
                <form action="{{route('post.destroy',$post['id'])}}" method='post'>
                    <div class="form-group">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-dark ml-4" type='submit'>삭제</button>
                    </div>                    
                </form>
                <form action="{{route('post.edit', $post['id'])}}" method='get'>
                    <div class="form-group">
                        <button class="btn btn-dark ml-3" type='submit'>수정</button>
                    </div>    
                </form>
            </div>
            <div>
                <div class='row bg-dark p-2 pl-3 text-light' style="border:1px solid #eee">다음글:&nbsp&nbsp
                    <a href='board.php?board=composer_board&&post_num=' class="text-light"><strong>ㅋㅋ</strong></a></div>
                <div class='row bg-dark p-2 pl-3 text-light'>이전글:&nbsp&nbsp
                    <a href='board.php?board=composer_board&&post_num=112' class="text-light"><strong>저도 발라드 올려볼께요!</strong></a></div>
            </div>
            <form action='reply_process.php' class="form-horizontal" method='post'>
                <div class="form-group py-3 pb-5">
                    <label for="reply">댓글:</label>
                    <textarea name='reply' id="reply" rows='5' class="form-control" required></textarea>
                    <button class="btn btn-dark mt-2" type='submit' style="float:right">댓글</button>
                    <input type='hidden' name='board' value='composer_board'>
                    <input type='hidden' name='post_num' value='113'>
                </div><hr>
            </form>
            <div class='replies'>
                <div>
                    <i class="pl-2"><strong>정해찬</strong> 님의 댓글</i>
                    <div class="p-2 mt-2" style="background:#ddd">ㅋㅋㅋㅋㅋㅋㅋ
                        <div class="text-right">2020-02-17</div>
                    </div>
                </div>
                <hr>
                <div>
                    <i class="pl-2"><strong>정해찬</strong> 님의 댓글</i>
                    <div class="p-2 mt-2" style="background:#ddd">ㅋㅋㅋㅋㅋㅋㅋ
                        <div class="text-right" style="font-size:13px;">2020-02-17</div>
                    </div>
                </div>
                <hr>
            </div>
        </div>
    </div>
@endsection