<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function sender() {
        return $this->belongsTo(User::class, 'sender_id');
    }
    
    public function receiver() {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
