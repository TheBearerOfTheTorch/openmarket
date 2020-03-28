<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    //i put this here from the homecontroller so that it blockd people who do cross paging
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //fetch data from the database index
        $posts = Post::orderBy('id','dsc')->paginate(10); 
        return view('posts.index')->with('posts',$posts);
        return view('posts.profilePage')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //create the post
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validating the data or file entered into the database the bearer of the torch
        $validatedData = $request->validate([
            'title' => 'required|unique:posts|max:255',
            'body' => 'required',
            'cover_image' =>'image|nullable|max:1999'
        ]);

        //handling file upload
        if($request ->hasFile('cover_image'))
        {
            //get the name with the extension the bearer of the torch
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();

            //get just the file name
            $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);

            //get extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();

            //filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            //upload the image its the bearer of the torch
            $path = $request->file('cover_image')->storeAs('public/cover_image',$fileNameToStore);
        }
        else
        {
            $fileNameToStore = 'noimage.jpg';
        }

        //create post
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id =  auth()->user()->id;
        $post->cover_image=$fileNameToStore;
        $post->save();

        return redirect('/posts')->with('success','Post created successfully');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //show the post from the database
        $posts = Post::find($id);
        return view('posts.show')->with('posts',$posts);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //editing the post
        $posts = Post::find($id);

        //checking for correct users
        if(auth()->user()->id !== $posts->user_id)
        {
            return redirect('/posts')->with('error','Unauthorized page');
        }
        //returning the posts after you've edited
        return view('posts.edit')->with('posts',$posts);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title' => 'required',
            'body' => 'required'
        ]);
        //handling file upload
        if($request ->hasFile('cover_image'))
        {
            //get the name with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();

            //get just the file name
            $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);

            //get extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();

            //filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            //upload the image
            $path = $request->file('cover_image')->storeAs('public/cover_image',$fileNameToStore);
        }
        //find a post
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($request ->hasFile('cover_image'))
        {
             $post->cover_image = $fileNameToStore;
        }
        $post->save();

        return redirect('/posts')->with('success','Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //find post
        $post = Post::find($id);

        //checking for correct users
        if(auth()->user()->id !== $post->user_id)
        {
            return redirect('/posts')->with('error','Unauthorized page');
        }
        if($post->cover_image != 'noimage.jpg')
        {
            //deleting the image
            storage::delete('public/cover_image/'.$post->cover_image);
        }
        //delete post
        $post->delete();

        //after deleting the post redirect to the posts page ..the bearer of the torch
        return redirect('/posts')->with('success','Post Removed');
    }
}
