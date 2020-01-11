
<form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ url('comment') }}">
    {{ csrf_field() }}
    <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
        <label for="comment" class="col-md-2 control-label">Comment</label>

        <div class="col-md-8">
            <input id="comment" type="text" class="form-control" name="comment" value="{{ old('comment') }}" required autofocus>

            @if ($errors->has('comment'))
                <span class="help-block">
                    <strong>{{ $errors->first('comment') }}</strong>
                </span>
            @endif
            <br>
            <button type="submit" class="btn btn-primary">
                Submit
            </button>
        </div>
    </div>    
    <input type="hidden" name="book_post_id" value="{{ $bookPost->id }}">
</form>

<table class="table table-striped">
    <tbody>
        <tr>
            <td></td>
            <th>Comments: </th>
            <td></td>
        </tr>
        @foreach ($comments as $comment)
        
        <tr>
            <td></td>
            <th scope="row"><b>{{ $comment->user->name }}: </b></th>
            <td>{{$comment->comment_body}}</td>
        </tr>
        {{-- <div class="well">
            {{ $comment->user->name }}
            {{$comment->comment_body}}
        </div> --}}
        @endforeach
    </tbody>
</table>