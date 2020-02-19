@extends('layouts/app')

@section('content')
        <form enctype="multipart/form-data" action="{{route('mail.store')}}" method="post">
            @csrf
            <div class="row">
                <div class="form-group col-md-9">
                    <label for="title" class="sr-only">제목</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="제목" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="reciever" class="sr-only">받는사람</label>
                    <input type="text" class="form-control" name="reciever" id="reciever" placeholder="받는사람(이름)"
                    @if(isset($_GET['reciever']))
                        value={{$_GET['reciever']}}
                    @endif
                    required>
                </div>
            </div>
            <div class="form-group">
                <label for="content" style="display:none">본문</label>
                <textarea name="content" class="form-control" id="content" rows="15" required></textarea>
            </div>
            <button type="submit" class="btn btn-dark" style="float:right">보내기</button>
        </form>
@endsection