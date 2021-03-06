<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordGenerated;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function getUsers(){
        $searchInput = Input::get('search');
        if($searchInput != ""){
            $users = User::where('name' , 'LIKE', '%' . $searchInput . '%')->paginate(env('PAGINATE_PER_PAGE', 16));
        }
        else{
            $users = User::latest()->paginate(env('PAGINATE_PER_PAGE', 16));
        }

        return view('admin.users', compact('users', 'searchInput'));
    }

    public function getBannedUsers(){
        $searchInput = Input::get('search');
        if($searchInput != ""){
            $users = User::where('name' , 'LIKE', '%' . $searchInput . '%')->whereIsBanned(true)->paginate(env('PAGINATE_PER_PAGE', 16));
        }
        else{
            $users = User::whereIsBanned(true)->latest()->paginate(env('PAGINATE_PER_PAGE', 16));
        }
        return view('admin.banned_users', compact('users', 'searchInput'));
    }

    public function banUser(Request $request){

        $user = User::find($request->user_id);
        // dd($user);
        if ($user->is_banned) {
            $user->is_banned = false;
        }else{
            $user->is_banned = true; 
                       
        } 
        $user->save();

        return redirect('users');
    }


    public function createUser(){
        
        return view('admin.createUser');
    
    }

    public function storeUser(Request $request){
        
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'mobile_number' => 'required|unique:users',
        ]);

        $randomPassword = str_random(8);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->isCreatedByAdmin = true;
        $user->mobile_number = $request->mobile_number;
        $user->password = bcrypt($randomPassword);

        switch ($request->user_type) {
            case 'Admin':
                $user->role_id = 1;

                break;
            
            case 'Publisher':
                $user->role_id = 2;
                
                break;

            case 'General User':
                $user->role_id = 3;
                
                break;
                
            default:
                $user->role_id = 3;

                break;
        }

        $user->save();

        Mail::to($user->email)->send(new PasswordGenerated($user->name, $randomPassword));

        return redirect('users');
    
    }

    
}
