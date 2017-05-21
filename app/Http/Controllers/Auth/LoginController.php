<?php

namespace App\Http\Controllers\Auth;

use Auth;
use DB;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/profile';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function login(Request $request)
    {
        $user_isset = DB::table('users')
        ->where('primary_card',$request->card_number)
        ->first();   
        if ($user_isset !== NULL){
            if ($user_isset->is_active == 1){
                if (Auth::attempt(['primary_card' => $request->card_number, 'password' => $request->password])) {
                    $log = new \App\Log;
                    $log->action_type = 1;
                    $log->message = date('Y-m-d H:i:s') . " | Пользователь " . Auth::user()->username . " вошел в систему";
                    $log->save();
                    return redirect()->route('profile');
                }
            } else {
                Session::flash('account-is-not-activated', 'Данный аккаунт не активирован! Проверьте почту, указанную при регистрации.');
                return redirect()->route('login');
            }
        } else {
            Session::flash('account-is-not-exist', 'Данный аккаунт не существует или был удален');
            return redirect()->route('login');
        }                 

    }
    public function logout(Request $request)
    {
        $logout_log = new \App\Log;
        $logout_log->action_type = 2;
        $logout_log->message = date('Y-m-d H:i:s') . " | Пользователь " . Auth::user()->username . " вышел из системы";
        $logout_log->save();
        Auth::logout();
        return redirect()->route('index');
    }
    /**
     *  Identify by card number
     * 
     */
    public function card_number()
    {
        return 'card_number';
    }
        /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
        public function authenticate()
        {
            if (Auth::attempt(['card_number' => $card_number, 'password' => $password])) {
            // Authentication passed...
                return redirect()->intended('profile');
            }
        }
    }
