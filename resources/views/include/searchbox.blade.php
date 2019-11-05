<form class="form-horizontal" method="GET" action="{{ url('book-posts') }}">
        
        
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