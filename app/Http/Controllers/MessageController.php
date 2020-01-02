<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function inbox()
    {
        $messages = Message::with(['sender', 'receiver'])->whereReceiverId(auth()->user()->id)->latest()->paginate(env('PAGINATE_PER_PAGE',16));


        return view('messages.index', compact('messages'));    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function send()
    {
        $temporaryReceiver = \App\User::find(2);
        return view('messages.send', compact('temporaryReceiver'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = new Message;
        $message->sender_id = auth()->user()->id;
        $message->receiver_id = $request->input('receiver_id');
        $message->msg_subject = $request->input('subject');
        $message->msg_body = $request->input('msg');
        $message->save();
        
        return redirect('messages/inbox');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        $message->read_at = time();
        $message->save();
        return view('messages.show', compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    // public function edit(Message $message)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, Message $message)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Message $message)
    // {
    //     //
    // }
}
