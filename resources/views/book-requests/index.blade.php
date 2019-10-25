@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Book Requests</div>

                <div class="panel-body">
                    @if(!$bookRequests->isEmpty())
                        <ul>
                            @foreach($bookRequests as $bookRequest)
                                <li>
                                    {{ $bookRequest->title . ', ' . $bookRequest->edition }}<br>
                                    by {{ $bookRequest->author }}
                                    
                                    <span class="pull-right"><small><strong>Requested by:</strong> {{ $bookRequest->user->name }}</small></span>
                                    <hr>
                                </li>
                            @endforeach
                        </ul>
                        
                        <center>{{ $bookRequests->links() }}</center>
                    @else
                        <p>No record found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
