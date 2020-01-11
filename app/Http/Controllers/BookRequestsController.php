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
}
