<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    //
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        //dd($request);
        //dd($request->get('email'));


        //Modify the request
        $request->request->add(['username' => Str::slug($request->username)]);

        //Validation
        $this->validate($request, [
            'name' => 'required|max:30',
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Authenticate the user
        Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]);

        // Redirect to posts.index with the username parameter
        return redirect()->route('posts.index', ['user' => Auth::user()->username]);

    }
}
