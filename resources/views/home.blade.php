@extends('layouts.app')

@section('content')
@include('include.chart');

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    User Name :{{auth()->user()->name}}<br>
                    Email :{{auth()->user()->email}}<br>
                    Contact:{{auth()->user()->mobile_number}}<br>
                    {{-- Email :{{$User['email']}} --}}
                    <table class="table">
                        <tbody>                          
                           <tr>                               
                                <th scope="row"><b>Total Book Posts : </b></th>
                                <td>{{ $totalBookPosts}}</td>
                            </tr>

                            <tr>                               
                                <th scope="row"><b>Total Book Requests: </b></th>
                                <td>{{$totalBookRequests}}</td>
                            </tr>

                            <tr>                               
                                <th scope="row"><b> Unread Messages : </b></th>
                                <td>{{ $messages['totalUnreadMessages']}}</td>
                            </tr>

                            <tr>                               
                                <th scope="row"><b> Received Messages : </b></th>
                                <td>{{ $messages['totalReceivedMessages']}}</td>
                            </tr>
                            
                            <tr>                               
                                <th scope="row"><b> Sent Messages : </b></th>
                                <td>{{ $messages ['totalSentMessages']}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
