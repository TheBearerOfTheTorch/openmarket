<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;

class FriendController extends Controller
{
     //preventing unathorised user page accessing
     public function __construct()
     {
         $this->middleware('auth');
     }
     //get the view for friends
    public function getIndex()
    {
        $friends = Auth::user()->friends();
        $requests = Auth::user()->friendRequests();
        return view('friends.index')->with('friends',$friends)
        ->with('requests',$requests);
    }

    //add chosen user as friend
    public function getAdd($name)
    {
        $user = User::where('name',$name)->first();

        //checking if the user can be found
        if(!$user)
        {
            return redirect()->route('home')->with('success','That user could not be found');
        }

        //checking if the other user has a friend request pending for us
        if(Auth::user()->hasFriendRequestPending($user) || $user->hasFriendRequestPending(Auth::user()))
        {
            return redirect()->route('profile.index',['name'=>$user->name])->with('success','Friend request already pending');
        }
        //checking if we are already friends
        if(Auth::user()->isFriendsWith($user))
        {
            return redirect()->route('profile.index',['name'=>$user->name])->with('success','You are already friends.');
        }
        //adding a friend
        Auth::user()->addFriend($user);
        return redirect()->route('profile.index',['name'=>$user->name])->with('success','Friend request sent');
    }
    //accepting friend request
    public function getAccept($name)
    {
        $user = User::where('name',$name)->first();

        //checking if the user could be found or not
        if(!$user)
        {
            return redirect()
            ->route('home')
            ->with('msg','That user could not be found');
        }
        //we can not add our selfs if the notty one tries via url they are taken home for misbehaving ......dixa zanna
        if(auth::user()->id === $user->id)
        {
            return redirect()->route('home');
        }
        //checking if you've actually received a friend request from this user
        if(!Auth::user()->hasFriendRequestReceived($user))
        {
            return redirect()->route('home');
        }

        //return back tpo the profile page
        return redirect()->route('profile.index',['name'=>$user->name])->with('success','Friend request accepted');
    }
}
