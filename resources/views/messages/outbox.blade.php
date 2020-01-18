@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Outbox
                    <span class="pull-right"><strong><a href="{{ url('messages/send') }}">Send
                                Message</a></strong></span>
                    {{-- <a href="{{ url('messages/send') }}">Send Message</a> --}}

                </div>

                <div class="panel-body">
                    @if(!$messages->isEmpty())
                    <ul>
                        @foreach($messages as $message)

                            <li>
                                To : {{ $message->receiver->name }} <br>
                                Subject : {{ $message->msg_subject}} <br>
                                Message : {{ str_limit($message->msg_body, $limit = 5, $end = '...') }}
                                <a href="inbox/{{$message->id}}">(show)</a><br>
                                <span class="pull-right"><small><strong>Sent at:</strong> {{ $message->created_at }}</small></span>
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