<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function post(){
        return $this->belongsTo('App\Models\Post');
    }

    public function commentReplies(){
        return $this->hasMany('App\Models\CommentReply');
    }

}
