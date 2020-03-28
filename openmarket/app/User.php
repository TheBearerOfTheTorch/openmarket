<?php

namespace App;

use App\Traits\Friendable;
use App\Status;
use App\Post;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use Friendable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','first_name','last_name', 'email', 'password','slug','gender','location'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    //one user has more than one post/ one to many relationship
    public function posts()
    {
        return $this->hasMany('App\Post');
    }
    //seaching the users
    public function getName()
    {
        if($this->first_name && $this->last_name)
        {
            return "{$this->first_name} {$this->last_name}";
        }
        if($this->first_name)
        {
            return $this->first_name;
        }
        return null;
    }
    public function getNameOrUsername()
    {
        return $this->getName() ?: $this->name;
    }
    public function getFirstNameOrUsername()
    {
        return $this->first_name ?: $this->name;
    }
    //this is from gravatar
    public function getAvatarUrl()
    {
        return "http://www.gravatar.com/avatar/{{md5($this->email)}}?d=mm&s=40";
    }
    //relate to the statuses (relationship for statuses)
    public function statuses()
    {
        return $this->hasMany('App\Status','user_id');
    }
    //friends of the user
    public function friendsOfMine()
    {
        return $this->belongsToMany('App\User','friends','user_id','friend_id');
    }
    //users who have this user as a friend
    public function friendOf()
    {
        return $this->belongsToMany('App\User','friends','friend_id','user_id'); 
    }
    //count user's friend
    public function friends()
    {
        return $this->friendsOfMine()->wherePivot('accepted',true)
        ->get()->merge($this->friendOf()->wherePivot('accepted',true)->get());
    }
    //this method graps friends request
    public function friendRequests()
    {
        return $this->friendsOfMine()->wherePivot('accepted',false)->get();
    }
    //geting pending request
    public function FriendRequestPending()
    {
        return $this->friendOf()->wherePivot('accepted',false)->get();
    }
    //check if the user has a friend request pending from another user
    public function hasFriendRequestPending(User $user)
    {
        return (bool) $this->friendRequestPending()->where('id',$user->id)->count();
    }
    //check if you have received a friend request from any particular user
    public function hasFriendRequestReceived(User $user)
    {
        return (bool) $this->friendRequests()->where('id',$user->id)->count();
    }
    //add friends to your friend request list
    public function addFriend(User $user)
    {
        $this->friendOf()->attach($user->id);
    }
    //accept friend request dixa zanna
    public function acceptFriendRequest(User $user)
    {
        $this->friendRequests()->where('id',$user->id)->first()->pivot()->update([
            'accepted'=>true,
        ]);
    }
    //check if you are friends with any particular dixa zanna
    public function isfriendsWith(User $user)
    {
        return (bool) $this->friends()->where('id',$user->id)->count();
    }
    //who or what have liked the status
    public function likes()
    {
        return $this->morphMany('App\Like','likeable');
    }
    //detarmining if the user has already liked the status
    public function hasLikedStatus(Status $status)
    {
        return (bool) $status->likes->where('user_id',$this->id)->count();
    }
}
