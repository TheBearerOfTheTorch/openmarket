<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //the relationship of the created post by the user
    //this is just for the post
    //one to many relationship
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
