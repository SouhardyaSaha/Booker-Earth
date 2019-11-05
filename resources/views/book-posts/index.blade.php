@extends('layouts.app')

@section('content')
{{-- <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                
                <div class="panel-heading">Book Posts</div>
                <div class="panel-body">
                        
                    @if(!$bookPosts->isEmpty())
                        <ul>
                            @foreach($bookPosts as $bookPost)
                                <li>
                                    {{ $bookPost->title . ', ' . $bookPost->edition }}<br>
                                    by {{ $bookPost->author }}
                                    
                                    <span class="pull-right"><small><strong>Posted by:</strong> {{ $bookPost->user->name }}</small></span>
                                    <hr>
                                </li>
                            @endforeach
                        </ul>
                        
                        <center>{{ $bookPosts->links() }}</center>
                    @else
                        <p>No record found.</p>
                    @endif
                    
                </div>
            </div>
        </div>
    </div> --}}

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
                <div class="thumbnail">
                    <img src = {{$bookPost->image_uri}} class="img-thumbnail" >
                    <div class="caption ">
                        <center>
                            <b>Book:</b>  {{ $bookPost->title }} <br>
                            <b>Author</b> : {{ $bookPost->author }} <hr>
                        </center>
                        <span class="pull-right"><small><strong>Posted by:</strong> {{ $bookPost->user->name }}</small></span>
                        <hr>
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
