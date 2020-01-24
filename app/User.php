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
        'name', 'email', 'password', 'mobile_number', 'is_banned', 'total_book_posts', 'is_email_verified'
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
        return $this->receivedMessages()->whereNull('read_at');
    }

    public function bookPosts() {
        return $this->hasMany(BookPost::class);
    }

    public function isAdmin(){
        return $this->role_id == 1;
    }

    public function isPublisher(){
        return $this->role_id == 2;
    }

    public function isUser(){
        return $this->role_id == 3;
    }

    // get the users except the signed one for message recipient
    public function scopeRecipients($query, $q, User $except) {
        return $query->where('id', '!=', $except->id)->where('name', 'LIKE', "%{$q}%");
            // ->where(function($query) use($q) {
            //     $query->where('name', 'LIKE', "%{$q}%");
            // });
    }

}
