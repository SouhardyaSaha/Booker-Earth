@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Inbox</div>

                <div class="panel-body">
                    @if(!$messages->isEmpty())
                        <ul>
                            @foreach($messages as $message)
                            
                            <li>
                                <b>From :   </b>{{ $message->sender->name }} <br>
                                <b>Subject   :  </b> {{ $message->msg_subject}} <br>
                                <b>Message   :  </b> {{  $message->msg_body }}<br>
                                {{-- by {{ $bookRequest->author }} --}}
                                
                                {{-- <span class="pull-right"><small><strong>Requested by:</strong> {{ $bookRequest->user->name }}</small></span> --}}
                                <hr>
                            </li>
                            @endforeach
                        </ul>
                        
                        <center>{{ $messages->links() }}</center>
                    @else
                        <p>No record found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
