@extends('layouts/app')

@section('content')
    <div class="p-4">
        <form enctype="multipart/form-data" action="{{route('post.update',$post['id'])}}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title" class="sr-only">제목</label>
                <input type="text" class="form-control" name="title" id="title" value="{{$post['title']}}" required>
            </div>
            <div class="form-group">
                <label for="content" style="display:none">본문</label>
                <textarea name="content" class="form-control" id="content" rows="15">{{$post['content']}}</textarea>
            </div>
            <div class="form-group" style="display:inline">
                <label for="content sr-only" style="display:none">파일</label>
                <input type="file" style="border:inherit" name="file" id="file">
            </div>
            <button type="submit" class="btn btn-dark" style="float:right">수정</button>
        </form>
    </div>
@endsection