<?php

namespace App\Http\Controllers;

use App\Status;
use Auth;
use User;
use Illuminate\Http\Request;

class TimelineController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //checking if the Auth user is loged in
        //passing all our status and friends to our timeline
        if(Auth::check())
        {
            //no replys filtered out
            $statuses = Status::notReply()->where(function($query)
            {
                return $query->where('user_id',Auth::user()->id)->orWhereIn('user_id',Auth::user()->friends()
                ->pluck('id'));
            })->orderBy('created_at','desc')->paginate(10);

            return view('timeline.index')->with('statuses',$statuses);
        }
        return view('timeline.index');
    }
}
