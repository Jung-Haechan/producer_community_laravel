<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Like;
use App\Mail;
use Auth;

class LikesController extends Controller
{
    public function show(Post $post) {
        // Likes 테이블에 기록 있는지 없는지 확인
        $already_like = 0;
        if(Auth::check()) {
            $already_like = LIKE::where('post_id', $post['id'])->where('user_id', Auth::user()->id)->count();
        }
        // 좋아요 개수 가져오기
        $like_number = POST::where('id', $post['id'])->pluck('like_number');
        return response()->json([
            'already_like' => $already_like,
            'like_number' => $like_number
        ], 200);
    }

    public function like(Post $post) {
        // 좋아요 개수가 29개이면 명예의 전당 헌액 메일 발송
        if($post['board']==='completed_board' && $post['like_number']===29) {
            MAIL::create([
                'title' => '[운영자] 당신의 작품이 명예의전당 헌액 조건에 부합합니다!',
                'content' => '축하드립니다! 아래의 형식을 작성해 주시면 명예의 전당에 올라갑니다!',
                'sender' => '운영자',
                'reciever' => $post['author'],
                'hall_of_fame' => $post['id'] //해당 게시글 정보를 테이블 열을 통해 전달
            ]);
        }
        // 좋아요 클릭 시 +1
        POST::where('id', $post['id'])->update([
            'like_number' => $post['like_number'] + 1
        ]);
        // Like 테이블에 기록하여 중복 방지
        LIKE::create([
            'post_id' => $post['id'],
            'user_id' => Auth::user()->id
        ]);
    }  
}
