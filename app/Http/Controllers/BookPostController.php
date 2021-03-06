<?php

namespace App\Http\Controllers;

use App\BookPost;
use App\Comment;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class BookPostController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $searchInput = Input::get('search');
        if ($searchInput != ""){
            $bookPosts = BookPost::with('bookPostOwner')->where('title', 'LIKE', '%' . $searchInput . '%')->whereIsAvailable(true)->paginate(env('PAGINATE_PER_PAGE', 16));
        } 
        else{
            $bookPosts = BookPost::with('bookPostOwner')->whereIsAvailable(true)->latest()->paginate(env('PAGINATE_PER_PAGE', 16));
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
            'title' => 'required',
            'author' => 'required',
            'image' => 'image|nullable|max:1999',
        ]);

        // auth()->user()->bookPosts()->create($request->all());

        // Handle Image Upload
        if ($request->hasFile('image')) {
            $fileNameWithExt = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();

            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;

            $path = $request->file('image')->storeAs('public/book_post/images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.png';
        }

        $bookPost = new BookPost;
        $bookPost->title = $request->input('title');
        $bookPost->author = $request->input('author');
        $bookPost->edition = $request->input('edition');
        $bookPost->user_id = auth()->user()->id;
        auth()->user()->total_book_posts++;


        if (!$request->hasFile('image') && $request->input('image_from_api') != '') {

            $bookPost->image_uri = $request->input('image_from_api');

        } else {

            $bookPost->image_uri = 'storage/book_post/images/' . $fileNameToStore;
        }

        $bookPost->save();
        auth()->user()->save();

        return redirect('book-posts')->with('success', 'Book Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BookPost  $bookPost
     * @return \Illuminate\Http\Response
     */
    public function show(BookPost $bookPost)
    {
        $comments = Comment::where('bookPost_id', '=', $bookPost->id)->latest()->paginate(10);
        return view('book-posts.show', compact('bookPost', 'comments'));
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
    public function destroy($id)
    {
        $bookPost = BookPost::whereId($id)->whereUserId(auth()->user()->id)->whereNull('deleted_at')->first();

        if (is_null($bookPost)) {
            return redirect()->back()->with('error', 'Invalid Operation');
        }

        $bookPost->delete();
        return redirect('book-posts')->with('success', 'Post Deleted');;
    }

    public function availableBook($id)
    {
        $bookPost = BookPost::find($id);
        // dd($bookPost);
        if ($bookPost->is_available) {
            $bookPost->is_available = false;
        } else {
            $bookPost->is_available = true;
        }

        $bookPost->save();

        return redirect()->back()->with('success', 'Operation Successful');
    }


    public function getMessage($id)
    {
        $bookPost = BookPost::with('bookPostOwner')->findOrFail($id);
        return view('book-posts.message', compact('bookPost'));
    }

    public function postMessage(Request $request)
    {
        $id = $request->get('book_post_id');
        $bookPost = BookPost::with('bookPostOwner')->findOrFail($id);

        $rec = $bookPost->bookPostOwner->id;
        $sender = auth()->user()->id;

        $message = new Message;
        $message->sender_id = $sender;
        $message->receiver_id = $rec;
        $message->msg_subject = $request->input('subject');
        $message->msg_body = $request->input('msg');
        // dd($message);
        $message->save();
        return redirect('book-posts')->with('success', 'Message Send please wait for reply');
    }


    public function myBookPosts(Request $request)
    {

        $bookPosts = BookPost::whereUserId(auth()->user()->id)->withTrashed()->latest()->paginate(16);

        return view('book-posts.myBookPosts', compact('bookPosts'));
    }
}
