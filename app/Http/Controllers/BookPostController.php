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
            $bookPosts = BookPost::where('title' , 'LIKE', '%' . $searchInput . '%')->paginate(env('PAGINATE_PER_PAGE', 16));
        }
        else{
            $bookPosts = BookPost::with('user')->latest()->paginate(env('PAGINATE_PER_PAGE', 16));
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
        
        $this->validate($request, [
            'image' => 'image|nullable|max:1999'
        ]);

        // auth()->user()->bookPosts()->create($request->all());
        
        // Handle Image Upload
        if ($request->hasFile('image')) {
            $fileNameWithExt = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();

            $fileNameToStore = $fileName.'_'.time().'.'.$extension;

            $path = $request->file('image')->storeAs('public/book_post/images', $fileNameToStore);
        }else{
            $fileNameToStore = 'noimage.png';
        }

        $bookPost = new BookPost;
        $bookPost->title = $request->input('title');
        $bookPost->author = $request->input('author');
        $bookPost->edition = $request->input('edition');
        $bookPost->user_id = auth()->user()->id;
        // $bookPost->image_uri = $fileNameToStore;
        $bookPost->image_uri = 'storage/book_post/images/'.$fileNameToStore;
        $bookPost->save();
        return redirect('book-posts');
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
