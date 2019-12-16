@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Message</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST"  action="{{ url('book-posts/$bookPost->id/message') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('receiver') ? ' has-error' : '' }}">
                            <label for="receiver" class="col-md-4 control-label">Receiver</label>

                            <div class="col-md-6">
                                <input id="receiver" type="text" class="form-control" name="receiver" value="{{ $bookPost->user->name }}" required autofocus readonly>
                                @if ($errors->has('receiver'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('receiver') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('Sender') ? ' has-error' : '' }}">
                            <label for="Sender" class="col-md-4 control-label">Sender</label>

                            <div class="col-md-6">
                                <input id="Sender" type="text" class="form-control" name="Sender" value="{{ Auth::user()->name }}" required autofocus readonly>
                                @if ($errors->has('Sender'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('receiver') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('book_name') ? ' has-error' : '' }}">
                            <label for="book_name" class="col-md-4 control-label">Book Name</label>

                            <div class="col-md-6">
                                <input id="book_name" type="text" class="form-control" name="book_name" value="{{ $bookPost->title }}" required autofocus readonly>
                                @if ($errors->has('Sender'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('receiver') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
                            <label for="subject" class="col-md-4 control-label">Subject</label>

                            <div class="col-md-6">

                                <input id="subject" type="text" class="form-control" name="subject" placeholder="Type your subject here..."  required autofocus>
                                <input type="hidden" name="book_post_id" value="{{ $bookPost->id }}">
                                @if ($errors->has('subject'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('subject') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('msg') ? ' has-error' : '' }}">
                            <label for="msg" class="col-md-4 control-label">Message</label>

                            <div class="col-md-6">
                                <textarea id="msg" type="text" class="form-control" name="msg" placeholder="Type your message here..." value="{{ old('msg') }}" required autofocus> </textarea>
                                @if ($errors->has('msg'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('msg') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        
                        <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                            Send
                                    </button>
                                </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
