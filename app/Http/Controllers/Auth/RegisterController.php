<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Session;
use DB;
use Mail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        $acception       = $request['acception'];
        $register_token  = $request['_token'];
        /**
         * CHECK CARD NUMBER ON EXISTING
         * @var [type]
         */
        $card_check = DB::table('users')
        ->where('card_number',$card_number)
        ->first();
        if ($card_check !== NULL){
            if ($card_check->card_number == $card_number){
                Session::flash('card-number-verify-fail', 'Хмм... Такая карта уже зарегистрирована!'); 
                return redirect()->back()->withInput();
            } 
        } 
        /**
         * CHECK EMAIL ON EXISTING
         * @var [type]
         */
        $email_check = DB::table('users')
        ->where('email',$email)
        ->first();
        if ($email_check !== NULL){
            if ($email_check->email == $email){
                Session::flash('email-verify-fail', 'Данный email уже занят!'); 
                return redirect()->back()->withInput();
            } 
        }
        /**
         * CHECK PASSWORDS AND INSERT DATA
         */
        if ($password_repeat == $password){
            /**
             * IF RULES ARE ACCEPTED
             * @var [type]
             */
            if ($acception == 1)
            {
             $user = new \App\User;
             $user->card_number = $card_number;
             $user->username = $card_number;
             $user->name = $card_number;
             $user->email = $email;
             $user->role_id = 31;
             $user->register_token = $register_token;
             $user->password = bcrypt($password);
             if ($user->save()){
               Mail::send('emails.registration',
                 ['card_number' => $card_number,
                 'password' => $password,
                 'register_token' => $register_token],
                 function ($m) use ($email){
                     $m->from('no-reply@etk21.ru', 'Единая транспортная карта');
                     $m->to($email)->subject('Добро пожаловать в личный кабинет держателя карты ЕТК!');
                 });
           }
       } else {
           Session::flash('acception-fail', 'Для активации карты необходимо принять условия политики конфиденциальности и обработки персональных данных'); 
           return redirect()->back()->withInput();
       };
       Session::flash('register-ok', 'Спасибо за активацию аккаунта!');
   } else Session::flash('register-fail', 'Пароли не совпадают, попробуйте снова');
   return redirect()->back();
        /**
         * SENT MAIL
         */
        
    }
/**
 * CONFIRM ACCOUNT
 * @param  [type] $register_token [description]
 * @return [type]                 [description]
 */
    public function confirmAccount($register_token){
        $account = DB::table('users')
                        ->where('register_token',$register_token)
                        ->first();
        if ($account == NULL){
            Session::flash('activation-failed', 'Хмм.. Активировать аккаунт не удалось. Позвоните нам или напишите для решения проблемы');
            return redirect()->route('login');
        } else {
            DB::table('users')
                ->update(['is_active' => 1, 'register_token' => NULL]);
            Session::flash('activation-success', 'Ваш email подтвержден! Теперь Вы можете войти в личный кабинет!');
            return redirect()->route('login');
        }
}
}
