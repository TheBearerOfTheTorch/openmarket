<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Requests;
use DB;
use Auth;
use Image;

class PagesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    //preventing unathorised page accessing
    public function __construct()
    {
        $this->middleware('auth');
    }

    //site static pages
    public function about()
    {
        return view('Pages.about');
    }
    public function profilepage()
    {
        return view('Pages.profilePage',array('user'=>Auth::user()));
    }
    public function update_profile(Request $request)
    {
        //handle the user upload images
        if($request->hasFile('profile'))
        {
            $profile = $request->file('profile');
            $filename = time().'.'.$profile->getClientOriginalExtension();
            Image::make($profile)->resize(300,300)->save(public_path('/storage/ProfilePictures/'.$filename));

            //getting the current logged in user
            $user = Auth::user();
            $user->profile = $filename;
            $user->save();
        }
        return view('Pages.profilePage',array('user'=>Auth::user()));
    }
    public function dashboard()
    {
        return view('Pages.dashboard');
    }

    //have to see from here if it hasa also to be included into the new intagrate
    public function findFriends()
    {
        //this function of the site deals with finding  friends
        //checking for friends currently not logged in
        $uid_zanna = Auth::user()->id;

        $allUsers_jully = DB::table('users')->leftJoin('posts','users.id','posts.user_id')->where('users.id','!=',$uid_zanna)->get();
    
        return view('Pages.findFriends',compact('allUsers_jully'));
    }
    public function sendRequest($id)
    {
        return Auth::user()->addFriend($id);
    }
}