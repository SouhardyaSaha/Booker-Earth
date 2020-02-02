@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Book Posts (Create)</div>

                <div class="panel-body">

                    <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ url('book-posts') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">Title</label>

                            <div class="col-md-6">
                                <input id="book-title-autocomplete" type="text" class="form-control" name="title"
                                    value="{{ old('title') }}" required autofocus>

                                @if ($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('edition') ? ' has-error' : '' }}">
                            <label for="edition" class="col-md-4 control-label">Edition</label>

                            <div class="col-md-6">
                                <input id="edition" type="text" class="form-control" name="edition"
                                    value="{{ old('edition') }}" required autofocus>

                                @if ($errors->has('edition'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('edition') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('author') ? ' has-error' : '' }}">
                            <label for="author" class="col-md-4 control-label">Author</label>

                            <div class="col-md-6">
                                <input id="author" type="text" class="form-control" name="author"
                                    value="{{ old('author') }}" required autofocus>

                                @if ($errors->has('author'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('author') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                            <label for="image" class="col-md-4 control-label">Image</label>

                            <div class="col-md-6">
                                <input id="image" type="file" class="form-control" name="image"
                                    value="{{ old('image') }}" autofocus>
                                <img src="" alt="" id="display_image_from_api" style="display: none">
                                <b id='overwrite_message' style="color: brown; display: none">You can overwrite this image by uploading yours</b>
                                <input id="image_from_api" type="text" value="" name="image_from_api">
                                @if ($errors->has('image'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
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

@section('script')

    
<script>
    let i = 0;
    $('#book-title-autocomplete').autocomplete({

        deferRequestBy: 500,
        serviceUrl: '{{ url('search-book') }}',
        noCache: true,
        minChars: 3,
        type: 'GET',
        dataType: 'json',
        onSelect: function (suggestion) {
            console.log(suggestion.data);
            document.getElementById("display_image_from_api").src = '';
            document.getElementById("image_from_api").value = '';
            document.getElementById("author").value = '';
            // For Google Books Api
            for(let i=0; i<suggestion.data.authors.length; i++){

                document.getElementById('author').value += suggestion.data.authors[i];
                if(i>0) document.getElementById('author').value += ', ';
            }
            if(suggestion.data.image_url != null) {
                show_image(suggestion.data.image_url, 200, 200, 'book image');
                document.getElementById("image_from_api").value = suggestion.data.image_url;
            }
                
            /*For Good Reads Api*/

            // document.getElementById('author').value += suggestion.data.author;
            // if(suggestion.data.image_url != null)
            //     show_image(suggestion.data.image_url, 200, 200, 'book image');
        },

    });

    function show_image(src, width, height, alt) {
        var img = document.getElementById("display_image_from_api");
        img.style.display = 'block';
        img.src = src;
        img.width = width;
        img.height = height;
        img.alt = alt;
        document.getElementById('overwrite_message').style.display = 'block';
    }

</script>

@endsection