@extends('layouts.app')

@section('content')

    <div class="container">
    {{-- Thumbnails starts --}}
    
    {{-- search Bar --}}
    <center>
        <form class="form-horizontal" method="GET" action="{{ url('bannedusers') }}">
    
    
            <div class="form-group{{ $errors->has('search') ? ' has-error' : '' }}">
                    <label for="search" class="col-md-3 mr-0 control-label"><i class="fa fa-search fa-2x"></i></label>
                
                <div class="col-md-6" >
                    <input id="search" type="text"  class="form-control" name="search" placeholder="Search" value = {{$searchInput}}> 
                    {{-- value="{{ old('search') }}" required autofocus --}}
    
                    @if ($errors->has('search'))
                        <span class="help-block">
                            <strong>{{ $errors->first('search') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </form>
    </center>
    <div class="panel panel-default">
        
    <div class="panel-heading"><b>Users</b>
        <a class="btn btn-primary btn-sm pull-right" href="create/user">Create User</a>
    </div>
    <div class="panel-body">
    @if(!$users->isEmpty())
        @foreach($users as $user)
            <div class="well">
                <b>Name: </b> {{ $user->name }} 
                @if ($user->isCreatedByAdmin)
                    <span style="color: lightcoral"><i class="fa fa-check-circle" aria-hidden="true"></i></span>                
                @endif
                <br>
                <b>Email: </b> {{ $user->email }} 

                <span class="pull-right"><small><strong><a href="/messages/send">Message</a></strong></small></span><br>
                        
                    <span class="pull-right"><small><strong>
                        <form method="POST" action="{{ route('banUser') }}">
                            {{ csrf_field() }}
                            <input type="hidden" value=" {{ $user->id }} " name="user_id">
                            @if ($user->is_banned)
                                <button  class="btn btn-success btn-sm" type="submit"><small> Activate User</small></button>
                            @else
                                <button  class="btn btn-danger btn-sm" type="submit"><small> Deactivate User</small></button>
                            @endif                                
                        </form>
                        </strong></small>
                    </span><br>
            </div>
        @endforeach
    @else
        <p>No record found.</p>
    @endif
</div>
</div>
    {{-- Thumnails end --}}
    <center>{{ $users->links() }}</center>
</div>
@endsection
