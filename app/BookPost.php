<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookPost extends Model
{
    protected $fillable = [
        'title', 'edition', 'author', 
    ];
    
    public function user() {
        return $this->belongsTo(User::class);
    }
}
