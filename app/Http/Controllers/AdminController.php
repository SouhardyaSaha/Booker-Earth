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
