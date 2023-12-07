<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'comment_id',
        'user_id',
        'reply'
    ];

    public function comments()
    {
        return $this->belongsTo(Comment::class,'reply_id','id');
    }
}
