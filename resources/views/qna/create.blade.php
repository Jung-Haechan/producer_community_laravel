@extends('layouts/app')

@section('content')
        <form enctype="multipart/form-data" action="{{route('qna.store')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="title" class="sr-only">제목</label>
                <input type="text" class="form-control" name="title" id="title" placeholder="제목" required>
            </div>
            <div class="form-group">
                <label for="question" style="display:none">구체적인 질문</label>
                <textarea name="question" class="form-control" id="question" rows="15" placeholder="구체적인 질문"></textarea>
            </div>
            <button type="submit" class="btn btn-dark" style="float:right">제출</button>
        </form>
@endsection