@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            {{-- search Bar --}}
            <form class="form-horizontal" method="POST" action="{{ url('book-posts/search') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('search') ? ' has-error' : '' }}">
                    <label for="search" class="col-md-4 control-label">Search</label>

                    <div class="col-md-6">
                        <input id="search" type="text" class="form-control" name="search" value="{{ old('search') }}" required autofocus>

                        @if ($errors->has('search'))
                            <span class="help-block">
                                <strong>{{ $errors->first('search') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                {{-- <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Search
                            </button>
                        </div>
                </div> --}}
            </form>
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
    </div>
</div>
@endsection
