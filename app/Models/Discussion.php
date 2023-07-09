<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = ['title', 'content'];

    public function messages()
    {
        return $this->hasMany(Message::class)->where('commentable_type', 'topic');
    }
  


}
