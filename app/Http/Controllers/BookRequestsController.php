<?php

namespace App\Http\Controllers;

use App\BookRequest;
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

}
