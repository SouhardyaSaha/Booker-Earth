@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Message</div>

                <div class="panel-body">
                    {{ $message->msg_body }}    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection