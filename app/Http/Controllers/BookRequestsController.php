<?php

namespace App\Http\Controllers;

use App\BookRequest;
use App\Message;
use Illuminate\Http\Request;

class BookRequestsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
    }

    public function index() {
        $bookRequests = BookRequest::with('user')->latest()->paginate(env('PAGINATE', 10));
        
        return view('book-requests.index', compact('bookRequests'));
    }
    
    public function create() {
        return view('book-requests.create');
    }
    
    public function store(Request $request) {
        auth()->user()->bookRequests()->create($request->all());
        
        return redirect('book-requests');
    }

    public function destroy(Request $request, $id) {
        $bookRequest = BookRequest::whereId($id)->whereUserId(auth()->user()->id)->whereNull('deleted_at')->first();

        if (is_null($bookRequest)) {
            return redirect()->back();
        }

        $bookRequest->delete();
        return redirect()->back();
    }

    public function getMessage($id) {
        $bookRequest = BookRequest::with('user')->findOrFail($id);
        return view('book-requests.message', compact('bookRequest'));
    }

    public function postMessage(Request $request){
        $id = $request->get('book_post_id');
        $bookPost = BookRequest::with('user')->findOrFail($id);

        $rec = $bookPost->user->id;
        $sender = auth()->user()->id;
        
        $message = new Message;
        $message->sender_id = $sender;
        $message->receiver_id = $rec;
        $message->msg_subject = $request->input('subject');
        $message->msg_body = $request->input('msg');
        // dd($message);
        $message->save();
        return redirect('book-requests');
    }

    public function myBookRequests(Request $request) {
        $bookRequests = BookRequest::whereUserId(auth()->user()->id)->withTrashed()->paginate(16);

        // dd($bookRequests);
        return view('book-requests.myBookRequests', compact('bookRequests'));
    }
}
