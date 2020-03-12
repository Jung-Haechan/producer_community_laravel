<?php

namespace App\Http\Controllers;

use App\Mail;
use App\User;
use App\Post;
use Illuminate\Http\Request;
use Auth;



class MailsController extends Controller
{
    public function __construct() {
        $this -> middleware('auth');
    }
    public function index()
    {
        //보낸 편지함, 받은 편지함 구분하여 다른 데이터 출력
        $mailbox = $_GET['mailbox'];
        if($mailbox === 'recieved') {
            $mails = MAIL::where('reciever', Auth::user()->name)->where('reciever_delete', 0)->orderBy('read_check')->orderBy('id', 'desc')->paginate(15);
        }
        elseif($mailbox === 'sent') {
            $mails = MAIL::where('sender', Auth::user()->name)->where('sender_delete', 0)->orderBy('id', 'desc')->paginate(15);
        }
        
        return view('mail/index', [
            'mailbox' => $mailbox,
            'mails' => $mails
        ]);
    }

    public function create(Request $request)
    {
        //쪽지쓰기
        return view('mail/create');
    }

    public function store(Request $request)
    {
        // 받는 사람 존재 여부 확인
        $is_reciever = USER::where('name', $request->input('reciever'))->count();
        if($is_reciever) {
            // 존재하면 Mails 테이블에 저장
            MAIL::create([
                'title' => $request -> input('title'),
                'content' => $request -> input('content'),
                'sender' => Auth::user()->name,
                'reciever' => $request -> input('reciever')
            ]);
        }
        return redirect(route('mail.index').'?mailbox=sent');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mail  $mail
     * @return \Illuminate\Http\Response
     */
    public function show(Mail $mail)
    {   
        $hof_post = null;
        // 안 읽은 메일일 때, 읽으면 읽은 메일로 업데이트
        if($_GET['mailbox']==='recieved'){
            MAIL::where('id', $mail['id'])->update([
                'read_check' => 1
            ]);
            // 명예의 전당 헌액 메일일 때, 해당 게시글을 view에 알려줌
            if($mail['hall_of_fame']!==0){
                $hof_post = POST::find($mail['hall_of_fame']);
            }
        }
        return view('mail/show', [
            'mail' => $mail,
            'mailbox' => $_GET['mailbox'],
            'hof_post' => $hof_post
        ]);
    }

    public function update(Mail $mail)
    {
        // 메일 삭제
        // 데이터베이스에서 삭제가 아닌, 보여지지만 않게 하는 방식
        $mailbox = $_POST['mailbox'];
        if($mailbox==='recieved') {
            MAIL::where('id', $mail['id'])->update([
                'reciever_delete' => 1
            ]);
        }
        elseif($mailbox==='sent') {
            MAIL::where('id', $mail['id'])->update([
                'sender_delete' => 1
            ]);
        }
        return redirect(route('mail.index').'?mailbox='.$mailbox);
    }

    public function group_update(Request $request)
    {
        // 체크박스 이용해 메일 여러개 한꺼번에 삭제
        $mailbox = $_POST['mailbox'];
        if($mailbox==='recieved') {
            foreach($request->input('del') as $del_mail) {
                MAIL::where('id', $del_mail)->update([
                    'reciever_delete' => 1
                ]);
            }
        }
        elseif($mailbox==='sent') {
            foreach($request->input('del') as $del_mail) {
                MAIL::where('id', $del_mail)->update([
                    'sender_delete' => 1
                ]);
            }
        }
        return redirect(route('mail.index').'?mailbox='.$mailbox);
    }
}
