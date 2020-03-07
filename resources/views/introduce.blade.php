@extends('layouts/app')

@section('content')
    <h2><a href="{{route('introduce')}}" class="text-dark">커뮤니티 소개</a></h2>
    <div class="container mt-4">
        <div class="row">
            <h4>훌륭하신 음악가 여러분! 기회의 땅에 오신 것을 환영합니다!</h4>
            <p class="bg-white p-2" style="font-size:13px">
                안녕하세요, 개발자 퍼뜩입니다. 저는 여러분이 그동안 유명해지지 못한 이유 중 하나가 <strong>기회 부족</strong>이라고 생각합니다.
                작곡가 여러분은 훌륭한 멜로디를 만들어도 노래를 불러줄 가수를 구하지 못했습니다.
                작사가 여러분의 주옥같은 가사는 그동안 훌륭한 멜로디를 만나지 못했고요.
                가수 뺨치는 노래실력을 가진 분들은 자기 노래 없이 커버영상만 유튜브에 죽어라 올리다가 포기합니다.
                저는 이러한 고민을 가진 여러분이 만나서 협업할 수 있다면 얼마나 좋을까 고민하게 되었습니다.
                그 고민의 결과물이 바로 <strong>노래랑놀래</strong> 입니다.
            </p>
        </div>
        <div class="row my-3">
            <div class="col-md-4">
                <h4>작곡게시판</h4>
                <p  style="font-size:13px">
                    <strong>작곡가 여러분은 작곡게시판에서 여러분의 노래를 들려주세요!</strong>
                    여러분이 올린 멜로디와 MR이 작사가에게 영감을 줄 수 있습니다.
                    아니면 작사가의 가사를 보고 작곡을 해서 올려도 좋고요.
                </p>
            </div>
            <div class="col-md-4">
                <h4>작사게시판</h4>
                <p style="font-size:13px">
                    <strong>작사가 여러분은 자신의 감정을 담은 가사를 작사게시판에 올려주세요!</strong>
                    여러분이 올린 가사가 작곡가에게 영감을 줄 수 있습니다.
                    아니면 작곡가의 음악을 듣고 작사를 해서 올려도 좋아요.
                </p>
            </div>
            <div class="col-md-4">
                <h4>보컬/악기게시판</h4>
                <p style="font-size:13px">
                    <strong>보컬/악기 게시판에서 여러분의 목소리나 악기연주실력을 뽐내주세요!</strong>
                    많은 작곡가분들이 자신의 노래를 불러줄 가수를 찾고 있을 것입니다.
                    만약 여러분이 선택받는다면, 여러분만의 노래가 생기는 겁니다.
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <h4>완성작게시판</h4>
                <p style="font-size:13px">
                    <strong>협업을 통해 완성한 노래를 완성작 게시판에 올려보세요!</strong>
                    이 중에 추천을 많이 받은 노래는 <strong>명예의 전당</strong>에 올라가게 됩니다. 
                    만약 반응이 좋으면 앨범으로 내도 좋지 않을까요? 
                </p>
            </div>
            <div class="col-md-4">
                <h4>자유게시판</h4>
                <p style="font-size:13px">
                    <strong>자유게시판에서 음악에 관한 여러분의 지식을 공유하세요!</strong>
                    작곡 팁, 노래 잘부르는 법, 악기 다루는 법, 보컬 구인 글 등등.
                    다양한 주제에 대해 토론해 보세요!.
                </p>
            </div>    
        </div>
    </div>
@endsection