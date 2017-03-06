<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function postLogin(Request $request){
    	$this->validate($request,[
            'username' => 'required',
            'password' => 'required'
            ]);
        $username = $request['username'];
        $password = $request['password'];
        if (Auth::attempt(['username' => $username, 'password' => $password])){
            return redirect()->route('sudo.pages.dashboard');
        }
        return redirect()->back();
    }
    public function postLogout(){
    	Auth::logout();
    	return redirect()->route('sudo.login');
    }
}
