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
            <h2 class="col-7"><a href="{{route('mail.index')}}?mailbox={{$mailbox}}" class="text-dark">{{config('objects.mailbox')[$mailbox]}}쪽지함</a></h2>
            <form action="{{route('mail.create')}}" method="get" class="col-5">
                <button type="submit" class="btn btn-dark" style="float:right">쪽지쓰기</button>
            </form>
        </div>
        <form action="{{route('mail.group_update')}}" method="post">
            @method('PUT')
            @csrf
            <input type="hidden" name="mailbox" value="{{$mailbox}}">
            <table class="table table-condensed table-striped" style="font-size:14px;">
                <thead class="bg-dark text-light">
                    <tr>
                        <td>체크</td>
                        <td>제목</td>
                        <td class="mobile-hide">{{config('objects.mailbox')[$mailbox.'_opposite']}}사람</td>
                        <td class="mobile-hide">날짜</td>
                    </tr>
                </thead>
                <tbody>
                @foreach($mails as $mail)
                    <tr>
                        <td><input type="checkbox" name="del[]" value="{{$mail['id']}}"></td>
                        <td>
                            <div>
                                @if($mail['read_check']===0&&$mailbox==='recieved')
                                <span class="text-danger">[New]</span>
                                @endif
                                <a href="{{route('mail.show', $mail['id'])}}?mailbox={{$mailbox}}" class="text-dark">{{$mail['title']}}</a>
                            </div>
                            <span class="desktop-hide pr-3">{{config('objects.mailbox')[$mailbox.'_opposite']}}사람:&nbsp</span>
                            <span class="desktop-hide pr-3">날짜:&nbsp {{explode(' ', $mail['created_at'])[0]}}</span>
                        </td>
                        <td class="mobile-hide">{{$mail['sender']}}</td>
                        <td class="mobile-hide">{{explode(' ', $mail['created_at'])[0]}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <button type="submit" class="btn btn-dark" style="float:right">삭제</button>
        </form>
        
        @if($mails)
            <div class="mx-auto mt-4">
                {{ $mails->appends(['mailbox' => $mailbox])->links() }}
            </div>
        @endif
@endsection