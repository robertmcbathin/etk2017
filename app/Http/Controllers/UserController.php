<?php

namespace App\Http\Controllers;
use Auth;
use \App\Log;
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
            $log = new \App\Log;
            $log->action_type = 1;
            $log->message = date('Y-m-d H:i:s') . " | Пользователь " . Auth::user()->username . " вошел в систему";
            $log->save();
            return redirect()->route('sudo.pages.dashboard');
        }
        return redirect()->back();
    }
    public function postLogout(){
        $logout_log = new \App\Log;
        $logout_log->action_type = 2;
        $logout_log->message = date('Y-m-d H:i:s') . " | Пользователь " . Auth::user()->username . " вышел из системы";
        $logout_log->save();
    	Auth::logout();
    	return redirect()->route('sudo.login');
    }
}
