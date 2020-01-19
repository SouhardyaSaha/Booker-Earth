@extends('layouts.app')

@section('content')

    <div class="container">
    
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
                        <p class="text-center">
                            <strong><a href="/book-posts/{{ $bookPost->id }}"> {{ $bookPost->title }}</a></strong>
                            by <strong><i>{{ $bookPost->author }}</i></strong>
                        </p>

                        <p class="text-right" style="margin-bottom: 0px;"><small><strong>Posted by:</strong> {{ $bookPost->bookPostOwner->name }}
                            @if ($bookPost->bookPostOwner->isCreatedByAdmin)
                                <span style="color: lightcoral"><i class="fa fa-check-circle" aria-hidden="true"></i></span>                
                            @endif
                        </small></p>
                        <p class="text-right"><small><strong><a href="/book-posts/{{ $bookPost->id }}/message">Message</a></small></strong></p>
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
