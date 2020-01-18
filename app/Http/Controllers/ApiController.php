<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getUsers(Request $request) {
        $users = [];
        
        $tempUsers = User::recipients($request->get('q'), auth()->user())->get();
        foreach($tempUsers as $user) {
            $users[] = ['id' => $user['id'], 'text' => $user['name'] ];

        }            
        
        return response()->json($users);
    }
}
