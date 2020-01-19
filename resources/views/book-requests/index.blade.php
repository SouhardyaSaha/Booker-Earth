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
                                    by {{ $bookRequest->author }} <br>

                                    @if ( auth()->user()->id  != $bookRequest->user->id)
                                        <a href="/book-requests/{{ $bookRequest->id }}/message">(Message)</a>                                        
                                    @endif

                                    @if ( auth()->user()->id  == $bookRequest->user->id)
                                        {{-- <a href="book-requests/{{ $bookRequest->id }}/delete">(Delete)</a>  --}}
                               
                                        <button class="btn btn-primary" data-catid={{$bookRequest->id}} data-toggle="modal" data-target="#delete">Delete</button>

                                    {{-- {{ Delete Modal }}                                        --}}
                                    
                                    <div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog"    aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                              <h4 class="modal-title text-center" id="myModalLabel">Delete Confirmation</h4>
                                            </div>
                                             <form action="{id}/delete" method="post">
                                                    {{method_field('delete')}}
                                                    {{csrf_field()}}
                                                <div class="modal-body">
                                                      <p class="text-center">
                                                          Are you sure you want to delete this?
                                                      </p>
                                                        <input type="hidden" name="" id="" value="">                          
                                                </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-success" data-dismiss="modal">No, Cancel</button>                                         
                                                <a href="book-requests/{{ $bookRequest->id }}/delete" class="btn btn-danger"> Yes ,Delete</a>
                                                  {{-- <button type="submit" class="btn btn-warning">Yes, Delete</button> --}}
                                                </div>
                                            </form>
                                          </div>
                                        </div>
                                      </div>
                                    
                                    
                                    
                                        @endif
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
