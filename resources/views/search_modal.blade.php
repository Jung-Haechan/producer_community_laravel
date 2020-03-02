<div class="row">
    <div class="modal" id="search" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                            검색하기
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="{{route('post.search')}}" method="post">
                                @csrf
                        <div class="container">
                            <div class="row">
                                <div class="form-group col-6">
                                    <select name="board" id="board" class="form-control">
                                        <option value="_board">전체 게시판</option>
                                            @foreach(config('objects.board') as $key => $value)
                                                <option value="{{$key}}"
                                                    @if($key==$board)
                                                        selected
                                                    @endif
                                                >
                                                {{$value}} 게시판</option>
                                            @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-6">
                                    <select name="range" id="" class="form-control">
                                        <option value="title">제목</option>
                                        <option value="title_content">제목+내용</option>
                                        <option value="author">글쓴이</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="value" placeholder="검색어" required>
                            </div>
                            <button class="btn btn-dark" style="float:right">검색</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>