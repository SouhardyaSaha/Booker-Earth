@extends('layouts.app')

@section('content')

    <div class="container">
    {{-- Thumbnails starts --}}
    
    {{-- search Bar --}}
    <center>  
            @include('include.searchbox')
    </center>
    <div class="panel panel-default">
        
    <div class="panel-heading">Book Posts</div>
    <div class="panel-body">
    @if(!$bookPosts->isEmpty())
        @foreach($bookPosts as $bookPost)
            <div class="col-xs-6 col-md-3">
                <div class="thumbnail" style="min-height: 500px;">
                    <img src = "{{$bookPost->image_uri}}" class="img-thumbnail" style="width:250px;height:300px;">
                    <div class="caption ">
                        <center>
                            <b>Book:</b> <a href="/book-posts/{{ $bookPost->id }}"> {{ $bookPost->title }} </a> <br>
                            <b>Author</b> : {{ $bookPost->author }}

                        </center>
                        <span class="pull-right"><small><strong>Posted by:</strong> {{ $bookPost->user->name }}</small></span><br>
                        <span class="pull-right"><small><strong></strong><a href="/book-posts/{{ $bookPost->id }}/message">Message </a></small></span><br>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p>No record found.</p>
    @endif
</div>
</div>
    {{-- Thumnails end --}}
    <center>{{ $bookPosts->links() }}</center>
</div>
@endsection
