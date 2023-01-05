<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\DB;

use Intervention\Image\Facades\Image;


class PostsController extends Controller
{

    public function index()
    {

        $posts = DB::table('posts')
            ->orderBy('id', 'DESC')
            ->paginate(5);


        return view('index', compact('posts'));
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function myIndex()
    {


        $users = DB::table('follows')
            ->where('user_id', auth()->user()->id)
            ->pluck('profile_id');

        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);

        return view('posts.myIndex', compact('posts'));
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


        $imagePath = request('image')->store('uploads', 'public'); // For Amazon S3, use ->store('uploads', 's3'); 

        /* Pull in intervention image
        composer require intervention/image 
        */

        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200); // Save every image as 1200 x 1200 px
        $image->save();

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
        ]);

        return redirect('/profiles/' . auth()->user()->id);
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }
}
