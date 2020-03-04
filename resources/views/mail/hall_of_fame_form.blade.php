<div>
    추천을 30개 이상 받으신 작품은, 귀하께서 {{$hof_post['created_at']}}에 작성하신<br>
<strong><a href="{{route('post.show', $hof_post['id'])}}?board={{$hof_post['board']}}">
        {{$hof_post['title']}}    
    </a></strong> 입니다.
</div>
<div class="contaier mt-3">    
    <form action="{{route('hof.store')}}" method="post">
    @csrf
        <input type="hidden" name="mail_id" value="{{$mail_id}}">
        <input type="hidden" name="file_name" value="{{$hof_post['file']}}">
        <div class="form-group">
            <input type="text" name="title" id="title" class="form-control" placeholder="노래 제목">
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <input type="text" name="composer" id="composer" class="form-control" placeholder="작곡가">
            </div>
            <div class="form-group col-md-4">
                <input type="text" name="lyricist" id="lyricist" class="form-control" placeholder="작사가">
            </div>
            <div class="form-group col-md-4">
                <input type="text" name="performer" id="performer" class="form-control" placeholder="보컬/악기">
            </div>
        </div>   
        <div class="form-group">
            <textarea name="description" id="description" class="form-control" cols="30" rows="10" placeholder="추가 설명">
            </textarea>
        </div>
        <button class="btn btn-dark" type="submit">제출</button>
    </form>
</div>