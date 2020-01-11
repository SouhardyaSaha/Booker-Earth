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
                                <tr align="center">
                                    <img src = '{{$bookPost->image_uri}}' class="img-thumbnail" style="width:250px;height:300px;">
                                </tr>
                                <br><br><br>
                                <tr>
                                    <td></td>
                                    <th scope="row"><b>Book: </b></th>
                                    <td>{{$bookPost->title}}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <th scope="row"><b>Post By: </b></th>
                                    <td>{{$bookPost->user->name}}</td>
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
