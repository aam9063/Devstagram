<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Validation\ValidatesRequests;


class PostController extends Controller
{
    use ValidatesRequests;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user) // User $user is a route model binding
    {
        $posts = Post::where('user_id', $user->id)->paginate(20); // 20 posts per page

        return view('dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    public function create()
    {

        return view('posts.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'required',
        ]);
        /*
        Post::create([
            'title' => $request -> title,
            'description' => $request -> description,
            'image' => $request -> image,
            'user_id' => Auth::id(),
        ]);
        */

        $request->user()->posts()->create([
            'title' => $request -> title,
            'description' => $request -> description,
            'image' => $request -> image,
            'user_id' => Auth::id(),
        ]);

        // Obtaining the authenticated user
        $user = Auth::user();

        // Redirecting to the user's posts
        return redirect()->route('posts.index', ['user' => $user->username]);
   }

   public function show(User $user, Post $post)
   {
       return view('posts.show', [
           'post' => $post
       ]);
   }
}


