<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class BookRequest extends Model
{
    protected $fillable = [
        'title', 'edition', 'author',
    ];
    
    public function user() {
        return $this->belongsTo(User::class);
    }
}
