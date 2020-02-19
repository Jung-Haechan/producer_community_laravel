@extends('layouts/app')
@section('css')
    <style>

    </style>
@endsection

@section('content')
        <h2><a href="{{route('mail.index')}}?mailbox={{$mailbox}}" class="text-dark">{{config('objects.mailbox')[$mailbox]}}쪽지함</a></h2>
        <div class='container bg-white' style="border-radius:20px">
            <div class='p-3'><strong>제목: {{$mail['title']}}</strong></div>
            <div class='row bg-dark text-light p-2 ' style="font-size:12px;">
                @if($mailbox==='recieved')
                    <div class='col-6'>From <strong>{{$mail['sender']}}</strong></div>
                @endif
                @if($mailbox==='sent')
                    <div class='col-6'>To <strong>{{$mail['reciever']}}</strong></div>
                @endif
                <div class='col-4'>{{$mail['created_at']}}</div>
            </div>
            <div class='p-3' style="min-height: 400px">{{$mail['content']}}</div>
            <div class="row">
                <form action="{{route('mail.update', $mail['id'])}}" method='post'>
                    <div class="form-group">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="mailbox" value="{{$mailbox}}">
                        <button class="btn btn-sm btn-dark ml-4" type='submit'>삭제</button>
                    </div>                 
                </form>
                <form action="{{route('mail.create')}}" method='get'>
                    <div class="form-group">
                        <input type="hidden" name="reciever" value="{{$mail['sender']}}">
                        <button class="btn btn-sm btn-dark ml-3" type='submit'>답장</button>
                    </div>                 
                </form>
        </div>
@endsection