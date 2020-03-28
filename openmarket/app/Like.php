<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    //like table and attaching likes to it
    protected $table='likeable';

    public function likeable()
    {
        return $this->morphTo();
    }
    //who liked something
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
