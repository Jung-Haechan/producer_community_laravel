
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>음악 협업 커뮤니티, {{config('app.name')}}</title>

    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('bootstrap/dist/css/bootstrap.css')}}">
    @yield('css', '')

</head>
<body style="background:#ddd">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark shadow-sm bg-dark">
            <div class="container">
                <a class="navbar-brand" style="color:pink" href="{{ url('/') }}">
                    {{config('app.name')}}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                        <a href="{{route('introduce')}}" class="nav-link">소개</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" id="navbarDropdown">게시판</a>
                            <ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item text-light" href="{{route('post.index')}}?board=composer_board">작곡게시판</a>
                                <a class="dropdown-item text-light" href="{{route('post.index')}}?board=lyricist_board">작사게시판</a>
                                <a class="dropdown-item text-light" href="{{route('post.index')}}?board=performer_board">보컬/악기게시판</a>
                                <a class="dropdown-item text-light" href="{{route('post.index')}}?board=completed_board">완성작게시판</a>
                                <a class="dropdown-item text-light" href="{{route('post.index')}}?board=free_board">자유게시판</a>
                            </ul>
                        </li>   
                        <li class="nav-item">
                            <a href="{{route('hof.index')}}" class="nav-link">명예의전당</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('qna.index')}}" class="nav-link">Q&A</a>
                        </li>
                            
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">로그인</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">회원가입</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}님 <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item text-light" href="{{route('mypage')}}">내정보</a>
                                    <a class="dropdown-item text-light" href="{{route('mail.index')}}?mailbox=recieved">받은쪽지함</a>
                                    <a class="dropdown-item text-light" href="{{route('mail.index')}}?mailbox=sent">보낸쪽지함</a>
                                    <a class="dropdown-item text-light" href="{{route('mail.create')}}">쪽지보내기</a>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}" 
                                    onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                    로그아웃
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </a>  
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <section class="py-4" style="min-height:500px">
            <div class="container py-4">
                <div class="row">
                    <article class="container col-xl-8 mb-5">
                            @yield('content')
                    </article>
                    <div class="mx-auto col-xl-4 row">
                        <div class="col-12 col-md-6 col-xl-12 mb-3">
                            <best></best>  
                        </div>
                        <aside class="mx-auto col-12 col-md-6 col-xl-12">
                            <div class="ad">
                                <a href="http://itempage3.auction.co.kr/DetailView.aspx?itemno=B658299283" target="blank">
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRFnWJ2Q8OPV3Q3KS-FDURW6LikaZO7MlZ_f6ADi8IFTSWeM_1t" class="col-12" alt="">
                                </a>                                
                            </div>
                        </aside>    
                    </div>
                </div>                   
            </div>                
        </section>

        <footer class="page-footer font-small p-4 bg-dark" style="color:#bbb">
            <div class="container">
                <div class="row">
                    <div class="col-4 text-center">Copyright &copy 2020 <h6>정해찬(Haecahn Jung)</h6></div>
                    <div class="col-4 text-center">Contact me
                        <li>010-8743-9486</li>
                    </div>
                        
                    <div class="col-4 text-center">
                        <a style="color:#bbb" href="" data-target="#copyright" data-toggle="modal">저작권정책 보기</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    @component('copyright_modal')
    @endcomponent
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
