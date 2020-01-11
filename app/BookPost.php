<?php

namespace App;

use App\comment;
use Illuminate\Database\Eloquent\Model;

class BookPost extends Model
{
    protected $fillable = [
        'title', 'edition', 'author', 
    ];
    
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function comment() {
        return $this->hasMany(comment::class);
    }
}
