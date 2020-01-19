<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    private function getAdminDasboard()
    {

        $message = 'you are logged in as Admin!';

        return compact('message');
    }

    private function getPublisherDasboard()
    {
        $message = 'you are logged in as Publisher';

        return compact('message');
    }

    private function getUserDasboard()
    {
        $message = 'you are logged in as User';

        return compact('message');
    }

    public function index()
    {
        // $messages = Message::with('sender')->whereSenderId(auth()->user()->id)->latest()->get();
        // $messages = auth()->user()::find(auth()->user()->id)->sentMessages()->get();

        // dd($messages);
        $data = [

            'totalBookPosts' => auth()->user()->bookPosts()->count(),
            'totalBookRequests' => auth()->user()->bookRequests()->count(),
            'messages' => [
                'totalReceivedMessages' => auth()->user()->receivedMessages()->count(),
                'totalSentMessages' => auth()->user()->sentMessages()->count(),
                'totalUnreadMessages' => auth()->user()->unreadMessages()->count(),

            ],

        ];

        switch (auth()->user()->role_id) {
            case 1:
                $data = array_merge($data, $this->getAdminDasboard());

                break;

            case 2:
                $data = array_merge($data, $this->getPublisherDasboard());
                break;

            case 3:
                $data = array_merge($data, $this->getUserDasboard());
                break;
        }

        // dd($data);
        //dd(Carbon::now()->subMinutes(10)->format('H:i:s Y-m-d'));
        return view('home', $data);
    }
}
