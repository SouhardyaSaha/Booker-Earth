<?php

use App\BookPost;
use App\User;
namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function bookPost(){
        return $this->belongsTo(BookPost::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
