<?php

namespace App\Http\Controllers;
use Auth;
use DB;
use \DateTime;
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
    /**
     * [getHomePage redirects to profile page]
     * @return [type] [description]
     */
    public function getHomePage(){
        return redirect()->route('profile');
    }
    /**
     * SHOW PROFILE
     * @return [type] [description]
     */
    public function showProfile(){
      $num   = substr(Auth::user()->card_number, 3, 6);
      $num = 333096;
      $operations = DB::table('SB_DEPOSIT_TRANSACTIONS')
                ->where('card_number', 'like',  $num)
                ->orderBy('transaction_date', 'DESC')
                ->get();
      foreach ($operations as $operation) {
        $format_date = new \DateTime($operation->transaction_date);
        $operation->transaction_date = $format_date->format('d.m.Y');
      }
        return view('pages.profile',[
            'operations' => $operations
            ]);
    }
    public function ajaxCheckCardOnExist(Request $request){
      $card = DB::table('users')
                ->where('card_number', $request->num)
                ->first();

      if ($card == NULL)
        return response()->json(['message' => 'error'],200);
      if ($card !== NULL)
        return response()->json(['message' => 'success', 'data' => $card],200);
    }
    public function ajaxCheckEmailExist(Request $request){
      $email = DB::table('users')
                ->where('email', $request->email)
                ->first();

      if ($email == NULL)
        return response()->json(['message' => 'error'],200);
      if ($email !== NULL)
        return response()->json(['message' => 'success', 'data' => $email],200);
    }

}
