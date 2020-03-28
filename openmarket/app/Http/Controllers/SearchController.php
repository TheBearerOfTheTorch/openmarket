<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //preventing unathorised page accessing
    public function __construct()
    {
        $this->middleware('auth');
    }
    //this controller of searching people in the search field
    public function getResults(Request $request)
    {
        //form query
        $query = $request->input('query');
        
        //if not a query return home
        if(!$query)
        {
            return redirect()->route('home');
        }
        
        //db result
        $users = User::where(DB::raw("CONCAT(name,' ',id)"),'LIKE',"%{$query}%")
        ->orWhere('email','LIKE',"%{$query}%")->get();

        return view('search.results')->with('users',$users);
    }
}
