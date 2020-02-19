@extends('layouts/app')

@section('content')
        <form enctype="multipart/form-data" action="{{route('post.store')}}" method="post">
            @csrf
            <div class="row">
                <div class="form-group col-md-9">
                    <label for="title" class="sr-only">제목</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="제목" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="board" class="sr-only">게시판</label>
                    <select id="board" name="board" class="form-control">
                        @foreach(config('objects.board') as $key => $value)
                        <option value="{{$key}}" 
                            @if($key==$_GET['board'])
                                selected
                            @endif
                        > 
                        {{$value}} 게시판</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="content" style="display:none">본문</label>
                <textarea name="content" class="form-control" id="content" rows="15"></textarea>
            </div>
            <div class="form-group" style="display:inline">
                <label for="content sr-only" style="display:none">파일</label>
                <input type="file" style="border:inherit" name="file" id="file">
            </div>
            <button type="submit" class="btn btn-dark" style="float:right">제출</button>
        </form>
@endsection