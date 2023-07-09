<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['discussion_id', 'content'];

    public function discussion()
    {
        return $this->belongsTo(Discussion::class);
    }
    public function comments()
    {
        return $this->hasMany(Message::class,'commentable_id')->where('commentable_type', 'comment');
    }
   
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
