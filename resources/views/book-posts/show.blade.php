@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Book Post</div>

                <div class="panel-body">
                        <table class="table">
                            
                            <tbody>
                                <tr>
                                    <center>
                                        <img src = '{{ url($bookPost->image_uri) }}' class="img-thumbnail" style="width:250px;height:300px;">
                                    </center>
                                </tr>
                                {{-- <a href="{{ $bookPost->id }}/delete" class="btn btn-danger">Delete</a> --}}


                                <button class="btn btn-danger" data-catid={{$bookPost->id}} data-toggle="modal" data-target="#delete">Delete</button>


                            {{-- Delete Modal --}}

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
                                        <a href="{{ $bookPost->id }}/delete" class="btn btn-danger"> Yes ,Delete</a>
                                          {{-- <button type="submit" class="btn btn-warning">Yes, Delete</button> --}}
                                        </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                              
                                <br><br>
                                <tr>
                                    <td></td>
                                    <th scope="row"><b>Book: </b></th>
                                    <td>{{$bookPost->title}}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <th scope="row"><b>Post By: </b></th>
                                    <td>{{$bookPost->bookPostOwner->name}}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <th scope="row"><b>Edition: </b></th>
                                    <td>{{$bookPost->edition}}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <th scope="row"><b>Author: </b></th>
                                    <td>{{$bookPost->author}}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <th scope="row"><b>Date: </b></th>
                                    <td>{{$bookPost->created_at}}</td>
                                </tr>
                            </tbody>
                          </table>
                        
                    </div>

                    @include('include.comment')
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
