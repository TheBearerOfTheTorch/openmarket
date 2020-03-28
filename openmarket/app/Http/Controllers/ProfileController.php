<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //preventing unathorised user page accessing
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getProfile($name)
    {
        //checking if the user exist or not
        $user = User::where('name',$name)->first();

        if(!$user)
        {
            abort(404);
        }
        $statuses = $user->statuses()->notReply()->get();
        return view('profile.index')
        ->with('user',$user)
        ->with('statuses',$statuses)
        ->with('authUserIsFriend',Auth::user()->isFriendsWith($user));
    }
    //this page will enable the user to fill in their own information
    public function getEdit()
    {
        return view('profile.edit');
    }
    //store the information from the user
    //access the request information and validate them
    public function getPost(Request $request)
    {
        $this->validate($request,[
            'first_name'=>'alpha|max:50',
            'last_name'=>'alpha|max:50',
            'location'=>'max:20',
        ]);
        //access the currently authenticated user
        Auth::user()->update([
            'first_name'=> $request->input('first_name'),
            'last_name'=> $request->input('last_name'),
            'location'=> $request->input('location'),
        ]);
        //redirect to the profile page with some info
        return redirect()->route('profile.edit')->with('success','Your profile has been updated');
    }
    //this page will enable the user to fill in their own information
    public function getEdittwo()
    {
        return view('profile.edittwo');
    }
    //this is for handling the basic information
    public function getPostTwo(Request $request)
    {
        $this->validate($request,[
            'date_of_birth'=>'max:50',
            'concentration'=>'alpha|max:100',
            'phone_number'=>'max:20',
            'high_school'=>'alpha|max:50',
            'university'=>'alpha|max:50',
        ]);
        //access the currently authenticated user
        Auth::user()->update([
            'date_of_birth'=> $request->input('date_of_birth'),
            'concentration'=> $request->input('concentration'),
            'phone_number'=> $request->input('phone_number'),
            'high_school'=> $request->input('high_school'),
            'university'=> $request->input('university'),
        ]);
        //redirect to the profile page with some info
        return redirect()->route('profile.edittwo')->with('success','Your profile has been updated');
    }
    //this page will enable the user to fill in their own information
    public function getEditthree()
    {
        return view('profile.editthree');
    }
    //this is for handling the Extended information
    public function getPostThree(Request $request)
    {
        $this->validate($request,[
            'name'=>'alpha|max:50',
            'political_view'=>'alpha|max:500',
            'interest'=>'alpha|max:100',
        ]);
        //access the currently authenticated user
        Auth::user()->update([
            'name'=> $request->input('name'),
            'political_view'=> $request->input('political_view'),
            'interest'=> $request->input('interest'),
        ]);
        //redirect to the profile page with some info
        return redirect()->route('profile.editthree')->with('success','Your profile has been updated');
    }
}
