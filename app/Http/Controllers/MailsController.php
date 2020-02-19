<?php

namespace App\Http\Controllers;

use App\Mail;
use App\User;
use Illuminate\Http\Request;
use Auth;



class MailsController extends Controller
{
    public function __construct() {
        $this -> middleware('auth');
    }
    public function index()
    {
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
        return view('mail/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $is_reciever = USER::where('name', $request->input('reciever'))->count();
        if($is_reciever) {
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
        if($_GET['mailbox']==='recieved'){
            MAIL::where('id', $mail['id'])->update([
                'read_check' => 1
            ]);
        }
        return view('mail/show', [
            'mail' => $mail,
            'mailbox' => $_GET['mailbox']
        ]);
    }

    public function update(Mail $mail)
    {
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
}
