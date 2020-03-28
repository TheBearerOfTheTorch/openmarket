<?php

namespace App\Traits;
use App\friendships;

trait friendable{
    public function test()
    {
        return 'hey there friend';
    }
    //this is where we deal with the adding friends crap
    public function addFriend($id)
    {
        $Friendship = friendships::create([
            'requester'=> $this->id,
            'user_requested'=>$id
        ]);
        //if the true you are freinds else it failed
        if($Friendship)
        {
            return $Friendship;
        }
        return 'failed';
    }
}
