<?php

namespace App\Http\Controllers;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{
    public function __construct()
    # Prevents unauthenticated users to access the post creation.
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id'); //Gets all user_ids where user is following.
        
        #$posts = Post::whereIn('user_id', $users)->get();//Ascending
        #$posts = Post::whereIn('user_id', $users)->orderBy('created_at', 'DESC')->get();//Ascending
        //$posts = Post::whereIn('user_id', $users)->latest()->get();//Ascending
        #$posts = Post::whereIn('user_id', $users)->latest()->paginate(5);
        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        
        $data = request()->validate([
            'caption' => 'required',
            'image' => ['required', 'image'],
        ]);

        $imagePath = request('image')->store('uploads', 'public');

        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
        $image->save();

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
        ]);

        return redirect('/profile/' . auth()->user()->id);
        
        /*$imagePath = request('image')->store('uploads','public');
        #dd(request('image')->store('uploads','s3'))
        #auth()->user()->posts()->create($data);

        dd("1");
        $image = Image::make(public_path("storage/{imagePath}"))->fit(1200,1200);
        $image->save(); 

        
        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
        ]);
        #\App\Post::create($data);
        #dd(request()->all());
        
        return redirect('/profile/'. auth()->user()->id);*/
    }

    public function show(\App\Post $post)
    {
        #dd($post);
        return view('posts.show',[
            'post' => $post,
        ]);


    }
}
