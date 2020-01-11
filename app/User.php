<?php

namespace App;

use App\BookRequest;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'mobile_number'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function bookRequests() {
        return $this->hasMany(BookRequest::class);
    }

    public function receivedMessages(){
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function sentMessages(){
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function unreadMessages(){
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function bookPosts() {
        return $this->hasMany(BookPost::class);
    }
}
