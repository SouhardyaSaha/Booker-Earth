<?php

namespace App;

use App\comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookPost extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'title', 'edition', 'author', 'is_available'
    ];
    
    public function bookPostOwner() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comment() {
        return $this->hasMany(comment::class);
    }
}
