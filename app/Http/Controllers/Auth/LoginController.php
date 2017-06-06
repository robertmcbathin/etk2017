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
        ->where('email',$request->email)
        ->first();   
        if ($user_isset !== NULL){
            if ($user_isset->is_active == 1){
                if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                    $log = new \App\Log;
                    $log->action_type = 1;
                    $log->message = date('Y-m-d H:i:s') . " | Пользователь " . Auth::user()->username . " вошел в систему";
                    $log->save();
                    $primary_card = DB::table('ETK_CARD_USERS')
                      ->join('ETK_CARD_TYPES', 'ETK_CARD_USERS.card_image_type', '=', 'ETK_CARD_TYPES.id')
                      ->where('ETK_CARD_USERS.user_id', Auth::user()->id)
                      ->select('ETK_CARD_USERS.*', 'ETK_CARD_TYPES.name as name')
                      ->first();
                    if ($primary_card = DB::table('ETK_CARD_USERS')
                      ->join('ETK_CARD_TYPES', 'ETK_CARD_USERS.card_image_type', '=', 'ETK_CARD_TYPES.id')
                      ->where('ETK_CARD_USERS.user_id', Auth::user()->id)
                      ->select('ETK_CARD_USERS.*', 'ETK_CARD_TYPES.name as name')
                      ->first()){
                        session()->put('current_card_number', $primary_card->number);
                        session()->put('current_card_image_type', '/pictures/cards/thumbnails/160/' . $primary_card->card_image_type . '.png');
                    } else {
                        session()->put('current_card_number', '999999999');
                        session()->put('current_card_image_type', '/pictures/cards/thumbnails/160/999.png');
                    }
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
            if (Auth::attempt(['email' => $email, 'password' => $password])) {
            // Authentication passed...
                return redirect()->intended('profile');
            }
        }
    }
