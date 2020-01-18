<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookRequest extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'title', 'edition', 'author',
    ];
    
    public function user() {
        return $this->belongsTo(User::class);
    }
}
