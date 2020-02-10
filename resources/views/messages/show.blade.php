@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Message</div>
                    <div class="panel-body">
                        <table class="table">
                            <tbody>
                                
                                <tr>  
                                    <th scope="row"><b>From :</b></th>
                                    <td>{{ $message->sender->name}}</td>
                                </tr>
                                <tr>

                                    <th scope="row"><b>To : </b></th>
                                    <td>{{ $message->receiver->name}}</td>
                                </tr>
                                <tr>

                                    <th scope="row"><b>Subject  </b></th>
                                    <td>{{ $message->msg_subject}}</td>
                                </tr>
                                <tr>

                                    <th scope="row"><b>Received </b></th>
                                    <td>{{ $message->created_at}}</td>
                                </tr>
                                 <tr>
 
                                    <th scope="row"><b>Body :</b></th>
                                    <td>{{$message->msg_body}}</td>
                                </tr>

                            </tbody>
                        </table>

                                   
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
.