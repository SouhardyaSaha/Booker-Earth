@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Search Result</div>

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
                        {{-- <center>{{ $bookPosts->links() }}</center> --}}
                    @else
                        <p>No record found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
