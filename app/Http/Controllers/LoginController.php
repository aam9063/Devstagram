<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Validation\ValidatesRequests;

class LoginController extends Controller
{
    use ValidatesRequests;
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);



        if(!Auth::attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('message', 'Invalid login details');
        }

        // Reescribir el nuevo password


        // Obtaining the authenticated user
        $user = Auth::user();

        // Redirecting to the user's posts
        return redirect()->route('posts.index', ['user' => $user->username]);
    }
}
