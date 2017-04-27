<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Session;
use Mail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/profile';
    /**
     * Where to redirect users after logout.
     *
     * @var string
     */
    protected $redirectAfterLogout = '/';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'card_number' => 'required|max:15',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'card_number' => $data['card_number'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function register(Request $request)
    {
        $this->validate($request,[
            'card_number' => 'required|min:9|max:9',
            'email' => 'required|max:255',
            'password' => 'required|min:6|max:150',
            'password_repeat' => 'required|min:6|max:150'
            ]);
        /**
         * INITIALIZE VARIABLES
         */
        $card_number     = $request['card_number'];
        $email           = $request['email'];
        $password        = $request['password'];
        $password_repeat = $request['password_repeat'];
        /**
         * CHECK PASSWORDS AND INSERT DATA
         */
        if ($password_repeat == $password){
            $user = new \App\User;
            $user->card_number = $card_number;
            $user->username = $card_number;
            $user->name = $card_number;
            $user->email = $email;
            $user->password = bcrypt($password);
            if ($user->save()){
              Mail::send('emails.registration',
                ['name' => $name,
                'email' => $email,
                'content' => $content],
              function ($m){
                $m->from('activation@etk-club.ru', 'ETK21.RU');
                $m->to('questions@etk21.ru')->subject('Новый вопрос с сайта');
            });
            }
            Session::flash('register-ok', 'Спасибо за активацию аккаунта!');
        } else Session::flash('register-fail', 'К сожалению, при сохранении данных произошла ошибка.');
        return redirect()->back();
        /**
         * SENT MAIL
         */
        
    }
}
