<?php

namespace App\Http\Controllers;

use App\BookPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class BookPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $searchInput = Input::get('search');
        if($searchInput != ""){
            $bookPosts = BookPost::where('title' , 'LIKE', '%' . $searchInput . '%')->paginate(env('PAGINATE', 10));
        }
        else{
            $bookPosts = BookPost::with('user')->latest()->paginate(env('PAGINATE', 10));
        }
        
        return view('book-posts.index', compact('bookPosts', 'searchInput'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('book-posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        auth()->user()->bookPosts()->create($request->all());
        
        return redirect('book-posts');
    }

    /**
     * Display the searched resource.
     *
     * @param  \App\BookPost  $bookPost
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        return 1234;
        // $searchinput = $request->input('search');
        // $bookPosts = BookPost::where('title' , 'LIKE', '%' . $searchinput . '%')->paginate(env('PAGINATE', 10));
        // // $bookPosts->paginate(env('PAGINTAE', 10));

        // return view('book-posts.search', compact('bookPosts'));
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\BookPost  $bookPost
     * @return \Illuminate\Http\Response
     */
    public function show(BookPost $bookPost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BookPost  $bookPost
     * @return \Illuminate\Http\Response
     */
    public function edit(BookPost $bookPost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BookPost  $bookPost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BookPost $bookPost)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BookPost  $bookPost
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookPost $bookPost)
    {
        //
    }
}
