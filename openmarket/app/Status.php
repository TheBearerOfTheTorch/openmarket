<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table='statuses';
    protected $fillable = [
        'body'
    ];
    //relate back to the user for specifc status 
    //we need to acces attaching likes to anything
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
    //chain our query to statuses
    public function scopeNotReply($query)
    {
        return $query->whereNull('parent_id');
    }
    //replys
    public function replies()
    {
        return $this->hasMany('App\Status','parent_id');
    }
    //who or what have liked the status
    public function likes()
    {
        return $this->morphMany('App\Like','likeable');
    }
}