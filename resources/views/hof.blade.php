@extends('layouts/app')

@section('content')
    <h2><a href="{{route('hof.index')}}" class="text-dark">명예의 전당</a></h2>
    <div class="container bg-white mt-4">
        @foreach($hofs as $hof)
            <div class="row p-3 border-bottom">
                <div class="col-md-4">
                    <audio controls style="width:100%">
                        <source src="{{Storage::url($hof['file_name'])}}">
                    </audio>
                </div>
                <div class="col-md-6 pt-2 pt-md-0">
                    <h6>제목: {{$hof['title']}}</h6>
                    <p style="font-size:12px">{{$hof['description']}}</p>
                    <div style="font-size:12px">
                        <span> 작곡가: {{$hof['composer']}} |</span>
                        <span> 작사가: {{$hof['lyricist']}} |</span>
                        <span> 보컬/악기: {{$hof['performer']}}</span>
                    </div>
                </div>
                @if(Auth::check() && Auth::user()->name==='운영자')
                    <form action="{{route('hof.destroy', $hof['id'])}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-dark mt-2" style="height: 40px;">삭제</button>
                    </form>
                @endif

            </div>
        @endforeach
    </div>
    @if($hofs)
        <div class="col-10">
            {{ $hofs->links() }}
        </div>
    @endif
@endsection