<table class="table table-striped">
    <tr>
        <td colspan="2">
            <form class="form-horizontal" method="POST" action="{{ url('comment') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                    <label for="comment" class="col-md-2 control-label">Comment</label>
                    <div class="col-md-12">
                        <input id="comment" type="text" class="form-control" name="comment" value="{{ old('comment') }}" required autofocus>
                        @if ($errors->has('comment'))
                            <span class="help-block">
                                <strong>{{ $errors->first('comment') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <input type="hidden" name="book_post_id" value="{{ $bookPost->id }}">
            
            </form>
        </td>
    </tr>

    <col width="150">
    <tr>
        <th colspan="2">Comments:</th>
    </tr>

    @foreach ($comments as $comment)

        <tr>
            <td><strong>{{ $comment->user->name }}</strong></td>
            <td>{{$comment->comment_body}}</td>
        </tr>
    @endforeach
</table>
