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
  /**
   * [modifyToFullNumber description]
   * @param  [type] $number [description]
   * @return [type]         [description]
   */
  public function modifyToFullNumber($number){
      $card_num_part2 = substr($number,1,2);
      $card_num_part3  = substr($number,3,6);
      if ($card_num_part2 !== 99){ $prefix = '01'; } else {$prefix = '02';}
      $full_card_number = $prefix . $card_num_part2 . $card_num_part3;
      return $full_card_number;
  }
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
                        session()->put('current_card_verified', $primary_card->verified);
                        session()->put('current_card_block_state', $primary_card->block_state);
                       /**
                        * get database card number
                        * @var [type]
                        */
                       $card_num_part1 = '01';
                       $card_num_part2 = substr(Session::get('current_card_number'),1,2);
                       $card_num_part3  = substr(Session::get('current_card_number'),3,6);
                       if ($card_info = DB::table('ETK_CARDS')
                           ->where('num', $card_num_part1 . $card_num_part2 . $card_num_part3 )
                           ->first()){
                           session()->put('current_card_balance', $card_info->ep_balance_fact);
                         $non_formatted_date = new \DateTime($card_info->date_of_travel_doc_kind_last);
                         $last_transaction = $non_formatted_date->format('d.m.Y H:i:s');
                         session()->put('current_card_last_transaction', $last_transaction);
                          /**
                          * CARD KIND : персональная или на предъявителя
                          */
                        switch ($card_info->kind) {
                         case 1:
                         session()->put('current_card_kind', 'Персональная');
                         break;
                         case 2:
                         session()->put('current_card_kind', 'На предъявителя');
                         break;
                         default:
                         session()->put('current_card_kind', 'Не определен');
                         break;
                        }
                         /**
                          * CARD STATE : Состояние карты(1-в обращении, 2-в блок списке, 3-заблокирована, 4-в деблок списке, 5-изъята, 6-чужая в блок, 7-чужая из блок, 8-Заблокирована по                  списку терминалов)
                          */
                         switch ($card_info->state) {
                             case 1:
                             session()->put('current_card_state', 'В обращении');
                             break;
                             case 2:
                             session()->put('current_card_state', 'В блокировочном списке');
                             break;
                             case 3:
                             session()->put('current_card_state', 'Заблокирована');
                             break;
                             case 4:
                             session()->put('current_card_state', 'В деблокировочном списке');
                             break;
                             case 5:
                             session()->put('current_card_state', 'Изъята');
                             break; 
                             default:
                             session()->put('current_card_state', 'Не определено');
                             break;
                         }
                         session()->put('current_card_image_type', '/pictures/cards/thumbnails/160/' . $primary_card->card_image_type . '.png');
                     }
                 } else {
                    session()->put('current_card_number', null);
                    session()->put('current_card_image_type', '/pictures/cards/thumbnails/160/999.png');
                }
                return redirect()->route('profile');
            } else {
              Session::flash('wrong-credentials', 'Неверный логин или пароль');
              return redirect()->route('login');
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
