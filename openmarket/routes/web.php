<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
|verify email
|
*/
Auth::routes(['verify' => true]);

//normal routing of pages dixa zanna
Route::get('/','PagesController@about');

//friendable and adding friends
Route::get('/test', function () {
    return Auth::user()->test();
});

Route::get('/addFriend/{id}','PagesController@sendRequest');

//finding friends who are not currently loged in loged in
Route::get('/findFriends','PagesController@findFriends');

//adding friends
//Route::get('/addFriends','PagesController@add');

//other page
Route::get('/profilePage','PagesController@profilepage');
Route::post('/profilePage','PagesController@update_profile');
Route::get('/dashboard','PagesController@dashboard');

/*
*home and the timeline
*/

//this is actually routing multiple routes at once dixa zanna
Route::resource('posts','PostsController');

/*
*home and timeline
*/
Auth::routes();
Route::get('/', 'HomeController@index')->name('home');

//you can not enter this views without verifying your email
Route::get('/home', 'HomeController@index')->name('home');


Route::get('/profile', function () {
    return 'just trying to see how this will work';
})->middleware('verified');



Route::get('/timeline', 'TimelineController@index')->name('timeline');
Route::get('/timeline',[
    'uses' => 'TimelineController@index',
    'as'=>'timeline.index'
]);

/*
*searching
*/
Route::get('/search',[
    'uses' => 'SearchController@getResults',
    'as'=>'search.results'
]);

/*
*profile page
*/
Route::get('/user/{username}',[
    'uses' => 'ProfileController@getProfile',
    'as'=>'profile.index'
]);
/*
*user editing their own information page
*/
Route::get('/profile/edit',[
    'uses' => 'ProfileController@getEdit',
    'as'=>'profile.edit'
]);

//posting the user edit information
Route::post('/profile/edit',[
    'uses' => 'ProfileController@getPost'
]);

/*
*user editing basic info
*/
Route::get('/profile/edittwo',[
    'uses' => 'ProfileController@getEdittwo',
    'as'=>'profile.edittwo'
]);

//posting the user edited information
Route::post('/profile/edittwo',[
    'uses' => 'ProfileController@getPosttwo'
]);

/*
*user editing the extended information
*/
Route::get('/profile/editthree',[
    'uses' => 'ProfileController@getEditthree',
    'as'=>'profile.editthree'
]);

//posting the user edit information
Route::post('/profile/editthree',[
    'uses' => 'ProfileController@getPostthree'
]);

/*
*friends route
*/
Route::get('/friends',[
    'uses' => 'FriendController@getIndex',
    'as'=>'friend.index'
]);
Route::get('/friends/add/{name}',[
    'uses' => 'FriendController@getAdd',
    'as'=>'friend.add'
]);
Route::get('/friends/accept/{name}',[
    'uses' => 'FriendController@getAccept',
    'as'=>'friend.accept'
]);

/**
*statuses
*/
Route::post('/status',[
    'uses' => 'StatusController@postStatus',
    'as'=>'status.post'
]);
Route::post('/status/{statusId}/reply',[
    'uses' => 'StatusController@postReply',
    'as'=>'status.reply'
]);
Route::get('/status/{statusId}/like',[
    'uses' => 'StatusController@getLike',
    'as'=>'status.like'
]);
/**
*messages
*/
Route::get('/messages',function(){
    return view('messaging.messages');
});
Route::get('/getMessages',function(){
    $allUsers = DB::table('users')->where('id','!=',Auth::user()->id)->get();
    return $allUsers;
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
