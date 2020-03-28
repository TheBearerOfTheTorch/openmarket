<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Status;
use App\User;
use Auth;


class StatusController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    //sending the status to the datatbase
    public function postStatus(Request $request)
    {
        //validate the characters for the status field
        $this->validate($request,[
            'status'=>'required|max:1000',
        ]);
        //create a status and insert to th status column in the database
        Auth::user()->statuses()->create([
            'body'=>$request->input('status'),
        ]);

        //redirect home
        return redirect()->route('timeline.index')->with('success','Status posted');
    }

    //this is for the statuses that we are replying to
    public function postReply(Request $request,$statusId)
    {
        //validate 
        $this->validate($request,[
            "reply-{$statusId}" =>'required|max:1000',
            'required'=>'The reply body is required'
        ]);
        //not reply scope
        $status =  Status::notReply()->find($statusId);

        //check if the status exist
        if(!$status)
        {
            return redirect()->route('timeline.index');//you can add message later
        }
        //check if the loged in user is friends with the current logged in user whose status this is
        if(!Auth::user()->isFriendsWith($status->user) && Auth::user()->id !== $status->user->id)
        {
            //you cant reply your own status
            return redirect()->route('timeline.index');
        }
        //crreating a status associate
        $reply = Status::create([
            'body'=>$request->input("reply-{$status->id}"),
        ])->user()->associate(Auth::user());

        //save the reply
        $status->replies()->save($reply);

        return redirect()->back();
    }
    //geting likes
    public function getLike($statusId)
    {
        $status = Status::find($statusId);

        //checking if the status exist
        if(!$status)
        {
            return redirect()->route('timeline.index');
        }
        //auth user not friends with the use liking the status
        if(!Auth::user()->isFriendsWith($status->user))
        {
            return redirect()->route('timeline.index');
        }
        //checking if they have already liked the status
        if(Auth::user()->hasLikedStatus($status))
        {
            return redirect()->back();
        }

        //creating likes to the database table
        $like = $status->likes()->create([]);

        //associate and save the like
        Auth::user()->likes()->save($like);
        
        return redirect()->back();

    }
}
