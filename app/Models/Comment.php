<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'comment',
        'user_id',
        'reply_id'
    ];

    public function replies()
    {
        return $this->hasmany(Reply::class,'comment_id','id');
    }
}
