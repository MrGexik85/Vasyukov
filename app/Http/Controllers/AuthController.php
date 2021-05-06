<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Response on GET query '/signup'
     * 
     * @return view
     */
    public function getSignup(){
        return view('auth.signup');
    }

    /**
     * Response on POST query '/signup'
     *
     * Creating a new user
     * 
     * @return redirect
     */
    public function postSignup(Request $request){
        $this->validate($request, [
            'email' => 'required|unique:users|email|max:255',
            'name' => 'required|alpha|max:45',
            'username' => 'required|unique:users|alpha_dash|max:255',
            'password' => 'required|min:6|max:255',
        ]);

        User::create([
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password')),
            'name' => $request->input('name'),
        ]);

        Auth::attempt($request->only(['username', 'password']));

        return redirect()->route('dashboard') ;
    }

    /**
     * Response on GET query '/signin'
     * 
     * @return view
     */
    public function getSignin(){
        return view('auth.signin');
    }

    /**
     * Response on POST query '/signin'
     *
     * Attempt auth for given username and password
     * 
     * @return redirect
     */
    public function postSignin(Request $request){
        $this->validate($request, [
            'username' => 'required|max:255',
            'password' => 'required|min:6|max:255',
        ]);

        if(!Auth::attempt($request->only(['username', 'password']), $request->has('remember'))){
            return redirect()->back();
        }

        return redirect()->route('dashboard');
    }
    
    /**
     * Response on GET query '/signout'
     * 
     * @return view
     */
    public function getSignout(){
        Auth::logout();

        return redirect()->route('home');
    }
}
