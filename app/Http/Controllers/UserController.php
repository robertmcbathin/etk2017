<?php

namespace App\Http\Controllers;
use Auth;
use DB;
use Session;
use \DateTime;
use \DateInterval;
use Hash;
use Mail;
use App\Mail\ChangeEmail;
use Carbon\Carbon;
use \App\Log;
use Storage;
use File;
use Illuminate\Http\Request;

class UserController extends Controller
{
  /**
   * [generatePassword description]
   * @param  integer $length [description]
   * @return [type]          [description]
   */
  public function generatePassword($length = 8)
  {
    $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
    $numChars = strlen($chars);
    $string = '';
    for ($i = 0; $i < $length; $i++) {
      $string .= substr($chars, rand(1, $numChars) - 1, 1);
    }
    return $string;
  }
    /**
     * [postLogin description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
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
      dd(session()->all());
      $cards = DB::table('ETK_CARD_USERS')
      ->join('ETK_CARD_TYPES', 'ETK_CARD_USERS.card_image_type', '=', 'ETK_CARD_TYPES.id')
      ->where('ETK_CARD_USERS.user_id', Auth::user()->id)
      ->select('ETK_CARD_USERS.*', 'ETK_CARD_TYPES.name as name')
      ->get();
      $current_card = DB::table('ETK_CARD_USERS')
      ->join('ETK_CARD_TYPES', 'ETK_CARD_USERS.card_image_type', '=', 'ETK_CARD_TYPES.id')
      ->where('ETK_CARD_USERS.user_id', Auth::user()->id)
      ->select('ETK_CARD_USERS.*', 'ETK_CARD_TYPES.name as name')
      ->first();
      /**
       * SHOW LAST IMPORT DIFF
       * @var [type]
       */
      Carbon::setLocale('ru');
      $last_import = DB::table('SB_DEPOSIT_IMPORTS')
      ->orderBy('created_at', 'DESC')
      ->first();
      $non_formatted_date = new Carbon($last_import->created_at);
      $last_import = $non_formatted_date->diffForHumans();
      /**
       * GET TRANSACTIONS
       * @var [type]
       */
      $operations = DB::table('SB_DEPOSIT_TRANSACTIONS')
      ->where('card_number', 'like',  '')
      ->orderBy('transaction_date', 'DESC')
      ->get();
      foreach ($operations as $operation) {
        $format_date = new \DateTime($operation->transaction_date);
        $operation->transaction_date = $format_date->format('d.m.Y');
      }
      /**
       * GET DETAILING REQUESTS
       * @var [type]
       */
      $requests = DB::table('ETK_DETAILING_REQUEST')
      ->where('user_id',Auth::user()->id)
      ->orderBy('created_at')
      ->get();

      foreach ($requests as $request) {
        $format_date = new \DateTime($request->date_start);
        $request->date_start = $format_date->format('d.m.Y');
        $format_date = new \DateTime($request->date_end);
        $request->date_end = $format_date->format('d.m.Y');
      }
       /**
       * GET CARD COUNT
       * @var [type]
       */
       $requests = DB::table('ETK_DETAILING_REQUEST')
       ->where('user_id',Auth::user()->id)
       ->orderBy('created_at')
       ->get();
      
      return view('pages.profile',[
        'operations' => $operations,
        'last_import' => $last_import,
        'requests' => $requests,
        'cards' => $cards,
        'current_card' => $current_card
     //   'card_count' => $card_count
        ]);
    }
    /**
     * [showDepositPage description]
     * @return [type] [description]
     */
    public function showDepositPage(){
      $cards = DB::table('ETK_CARD_USERS')
      ->join('ETK_CARD_TYPES', 'ETK_CARD_USERS.card_image_type', '=', 'ETK_CARD_TYPES.id')
      ->where('ETK_CARD_USERS.user_id', Auth::user()->id)
      ->select('ETK_CARD_USERS.*', 'ETK_CARD_TYPES.name as name')
      ->get();
      $current_card = DB::table('ETK_CARD_USERS')
      ->join('ETK_CARD_TYPES', 'ETK_CARD_USERS.card_image_type', '=', 'ETK_CARD_TYPES.id')
      ->where('ETK_CARD_USERS.user_id', Auth::user()->id)
      ->select('ETK_CARD_USERS.*', 'ETK_CARD_TYPES.name as name')
      ->first();
      return view('pages.profile.deposit',[
                'cards' => $cards,
        'current_card' => $current_card]);
    }
    /**
     * [showDepositHistory description]
     * @return [type] [description]
     */
    public function showDepositHistory(){
      $num   = substr(Session::pull('current_card_number'),3,6);
      /**
       * SHOW LAST IMPORT DIFF
       * @var [type]
       */
      Carbon::setLocale('ru');
      $last_import = DB::table('SB_DEPOSIT_IMPORTS')
      ->orderBy('created_at', 'DESC')
      ->first();
      $non_formatted_date = new Carbon($last_import->created_at);
      $last_import = $non_formatted_date->diffForHumans();
            /**
       * GET TRANSACTIONS
       * @var [type]
       */

      $operations = DB::table('SB_DEPOSIT_TRANSACTIONS')
        ->where('card_number', 'like',  $num)
        ->orderBy('transaction_date', 'DESC')
        ->get();
        foreach ($operations as $operation) {
          $format_date = new \DateTime($operation->transaction_date);
          $operation->transaction_date = $format_date->format('d.m.Y');
        }
      $cards = DB::table('ETK_CARD_USERS')
      ->join('ETK_CARD_TYPES', 'ETK_CARD_USERS.card_image_type', '=', 'ETK_CARD_TYPES.id')
      ->where('ETK_CARD_USERS.user_id', Auth::user()->id)
      ->select('ETK_CARD_USERS.*', 'ETK_CARD_TYPES.name as name')
      ->get();
      $current_card = DB::table('ETK_CARD_USERS')
      ->join('ETK_CARD_TYPES', 'ETK_CARD_USERS.card_image_type', '=', 'ETK_CARD_TYPES.id')
      ->where('ETK_CARD_USERS.user_id', Auth::user()->id)
      ->select('ETK_CARD_USERS.*', 'ETK_CARD_TYPES.name as name')
      ->first();
      $data = Session::all();
      dd($data);
              return view('pages.profile.deposit_history',
          ['operations' => $operations,
          'last_import' => $last_import,
          'cards' => $cards,
          'current_card' => $current_card
          ]);
      }
    /**
     * [showDetailsRequestForm description]
     * @return [type] [description]
     */
    public function showDetailsRequestForm(){
      $cards = DB::table('ETK_CARD_USERS')
      ->join('ETK_CARD_TYPES', 'ETK_CARD_USERS.card_image_type', '=', 'ETK_CARD_TYPES.id')
      ->where('ETK_CARD_USERS.user_id', Auth::user()->id)
      ->select('ETK_CARD_USERS.*', 'ETK_CARD_TYPES.name as name')
      ->get();
      $current_card = DB::table('ETK_CARD_USERS')
      ->join('ETK_CARD_TYPES', 'ETK_CARD_USERS.card_image_type', '=', 'ETK_CARD_TYPES.id')
      ->where('ETK_CARD_USERS.user_id', Auth::user()->id)
      ->select('ETK_CARD_USERS.*', 'ETK_CARD_TYPES.name as name')
      ->first();
      return view('pages.profile.details_request', [
        'cards' => $cards,
        'current_card' => $current_card
        ]);
    }
/**
 * [showDetailsHistory description]
 * @return [type] [description]
 */
public function showDetailsHistory(){
      dd(session()->all());
      /**
       * GET DETAILING REQUESTS
       * @var [type]
       */
      $requests = DB::table('ETK_DETAILING_REQUEST')
      ->where('user_id',Auth::user()->id)
      ->where('card_number', Session::pull('current_card_number'))
      ->orderBy('created_at')
      ->get();

      foreach ($requests as $request) {
        $format_date = new \DateTime($request->date_start);
        $request->date_start = $format_date->format('d.m.Y');
        $format_date = new \DateTime($request->date_end);
        $request->date_end = $format_date->format('d.m.Y');
      }

      $cards = DB::table('ETK_CARD_USERS')
      ->join('ETK_CARD_TYPES', 'ETK_CARD_USERS.card_image_type', '=', 'ETK_CARD_TYPES.id')
      ->where('ETK_CARD_USERS.user_id', Auth::user()->id)
      ->select('ETK_CARD_USERS.*', 'ETK_CARD_TYPES.name as name')
      ->get();
      $current_card = DB::table('ETK_CARD_USERS')
      ->join('ETK_CARD_TYPES', 'ETK_CARD_USERS.card_image_type', '=', 'ETK_CARD_TYPES.id')
      ->where('ETK_CARD_USERS.user_id', Auth::user()->id)
      ->select('ETK_CARD_USERS.*', 'ETK_CARD_TYPES.name as name')
      ->first();
      return view('pages.profile.details_history',
        ['requests' => $requests,
        'cards' => $cards,
        'current_card' => $current_card
        ]);
    }
/**
 * [showSettings description]
 * @return [type] [description]
 */
public function showSettings(){
  $cards = DB::table('ETK_CARD_USERS')
  ->join('ETK_CARD_TYPES', 'ETK_CARD_USERS.card_image_type', '=', 'ETK_CARD_TYPES.id')
  ->where('ETK_CARD_USERS.user_id', Auth::user()->id)
  ->select('ETK_CARD_USERS.*', 'ETK_CARD_TYPES.name as name')
  ->get();
  $current_card = DB::table('ETK_CARD_USERS')
      ->join('ETK_CARD_TYPES', 'ETK_CARD_USERS.card_image_type', '=', 'ETK_CARD_TYPES.id')
      ->where('ETK_CARD_USERS.user_id', Auth::user()->id)
      ->select('ETK_CARD_USERS.*', 'ETK_CARD_TYPES.name as name')
      ->first();
  return view('pages.profile.settings',[
    'cards' => $cards,
    'current_card' => $current_card
    ]);
}
    /**
     * NAME CHANGING
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function postChangeName(Request $request){
      $new_name = $request['name'];
      $user_id = $request['user_id'];
      $user = \App\User::find($user_id);
      $user->name = $new_name;
      if ($user->save()){
        Session::flash('name-changed-successfully', 'Имя успешно изменено');
        return redirect()->back();
      } else {
       Session::flash('name-changed-unsuccessfully', 'Изменить имя не удалось');
       return redirect()->back();
     }
   }
    /**
     * CHANGE PASSWORD
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function postChangePassword(Request $request){
      $old_password    = $request['old_password'];
      $new_password    = $request['new_password'];
      $password_repeat = $request['password_repeat'];
      $user_id         = $request['user_id'];
      $user = \App\User::find($user_id);
      if (Hash::check($old_password, $user->password)){
        if ($new_password == $password_repeat){
          $user->password = bcrypt($new_password);
          if ($user->save()){
            Session::flash('password-changed-successfully', 'Пароль успешно изменен');
            return redirect()->back();
          } else {
            Session::flash('password-changed-unsuccessfully', 'Упс... Пароль изменить не удалось');
            return redirect()->back();
          }
        } else {
          Session::flash('wrong-repeat', 'Неправильный повторный ввод пароля');
          return redirect()->back();
        }
      } else {
        Session::flash('wrong-password', 'Указан неправильный пароль');
        return redirect()->back();
      }
    }
          /**
     * DELETE CARD
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function postDeleteCard(Request $request){
            $user_id              = $request['user_id'];
            $current_card         = $request['current_card'];
            DB::table('ETK_CARD_USERS')
            ->where('number', $current_card)
            ->delete();
            Session::flash('delete_card_success', 'Карта успешно удалена');
            return redirect()->back();
    }
      /**
     * ADD CARD
     * @param  Request $request [description]
     * @return [type]           [description]
     */
      public function postAddCard(Request $request){
        $this->validate($request,[
          'card_number' => 'required|min:9|max:9'
          ]);
        $card_type   = $request['card_type'];
        $user_id     = $request['user_id'];
        $card_number = $request['card_number'];
        if (!is_numeric($card_number)){
          Session::flash('card_is_not_numeric', 'Введенный номер не является числом. Проверьте и попробуйте еще раз');
          return redirect()->back();
        }else {
          $num   = substr($card_number, 0, 3);
          $card = new \App\Usercard;
          $card->number = $card_number;
          $card->serie  = $num;
          switch ($card_type) {
            case '023':
            $card_type = 1;
            break;
            case '021':
            $card_type = 7;
            break;
            case '025':
            $card_type = 5;
            break;
            case '026':
            $card_type = 8;
            break;
            case '033':
            $card_type = 9;
            break;
            case '034':
            $card_type = 10;
            break;

            default:
                                        # code...
            break;
          }
          $card->card_image_type   = $card_type;
          $card->user_id = $user_id;
          if ($card->save()){
            Session::flash('add_card_success', 'Карта успешно добавлена!');
            return redirect()->back();
          } else {
            Session::flash('add_card_fail', 'При добавлении карты произошла ошибка. Попробуйте повторить операцию позднее');
            return redirect()->back();
          }
        }
      }
      /**
     * DELETE ACCOUNT
     * @param  Request $request [description]
     * @return [type]           [description]
     */
      public function postDeleteAccount(Request $request){
        $user_id         = $request['user_id'];
        $user = \App\User::find($user_id);
        if ($user->delete()){
         Session::flush();
         Session::flash('account-deleted', 'Аккаунт удален');
         $log = new \App\Log;
         $log->action_type = 5;
         $log->message = date('Y-m-d H:i:s') . " | Удален аккаунт пользвателя с номером карты " . $user->card_number;
         $log->save();
         return redirect()->route('register');
       } else {
        Session::flash('account-not-deleted', 'Удалить аккаунт не удалось');
        return redirect()->route('register');
      }
    }
      /**
     * CHANGE PHONE
     * @param  Request $request [description]
     * @return [type]           [description]
     */
      public function postChangePhone(Request $request){
        $this->validate($request, [
          'phone' => 'regex:/^[0-9\-\+]{9,15}$/'
          ]);
        $user_id   = $request['user_id'];
        $new_phone = $request['phone'];  
        if ($user = \App\User::find($new_phone)){
          Session::flash('user_with_this_phone_exists', 'Пользователь с таким номером телефона уже зарегистрирован!');
          return redirect()->back();
        }
        $user = \App\User::find($user_id);
        $user->phone = $new_phone;
        if ($user->save()){
         Session::flash('phone_number_saved', 'Номер телефона успешно изменен');
         return redirect()->back();
       } else {
         Session::flash('phone_number_failed', 'Сохранить номер не удалось');
         return redirect()->back();
       }              
     }
     /**
     * CHANGE EMAIL
     * @param  Request $request [description]
     * @return [type]           [description]
     */
     public function postChangeEmail(Request $request){
      $user_id   = $request['user_id'];
      $new_email = $request['email'];  
      $token     = $request['_token'];
      if ($user = \App\User::find($new_email)){
        Session::flash('user_with_this_email_exists', 'Пользователь с таким адресом уже зарегистрирован!');
        return redirect()->back();
      }
      $user      = \App\User::find($user_id);
      $temp_email = DB::table('ETK_TEMP_EMAILS')
      ->insert([
        'user_id' => $user_id,
        'email'   => $new_email,
        'token'   => $token
        ]);
      if (Mail::to($request->email)->send(new ChangeEmail($user,$token))){
       Session::flash('acception_email_send', 'На новый адрес электронной почты было отправлено письмо с подтверждением. Для смены адреса пройдите по ссылке в нем.');
       return redirect()->back();
     } else {
       Session::flash('acception_email_failed', 'Не удалось отправить письмо с подтверждением на новый адрес. Повторите попытку позже');
       return redirect()->back();
     }              
   }
     /**
     * SET CURRENT CARD
     * @param  Request $request [description]
     * @return [type]           [description]
     */
     public function setCurrentCard($current_card,$user_id){
      $card = DB::table('ETK_CARD_USERS')
      ->join('ETK_CARD_TYPES', 'ETK_CARD_USERS.card_image_type', '=', 'ETK_CARD_TYPES.id')
      ->where('ETK_CARD_USERS.user_id', Auth::user()->id)
      ->where('ETK_CARD_USERS.number', $current_card)
      ->select('ETK_CARD_USERS.*', 'ETK_CARD_TYPES.name as name')
      ->first();
      session()->put('current_card_number', $current_card);
      session()->put('current_card_image_type', '/pictures/cards/thumbnails/160/' . $card->card_image_type . '.png');
      return redirect()->back();         
    }
    public function getConfirmEmailChanging($token){
      if ($temp = DB::table('ETK_TEMP_EMAILS')
        ->where('token', $token)
        ->first()){
        $user = \App\User::find($temp->user_id);
      $user->email = $temp->email;
      if ($user->save()){
       Session::flash('new_email_accepted', 'Адрес электронной почты был успешно изменен');
       DB::table('ETK_TEMP_EMAILS')
       ->where('token', $token)
       ->delete();
       return redirect()->route('login');
     } else {
       Session::flash('new_email_denied', 'Подтвердить новый адрес не удалось');
       return redirect()->route('login');
     }
   }
 }

 public function postRequestDetails(Request $request){
  $this->validate($request,[
    'date_start' => 'required',
    'date_end' => 'required'
    ]);

  $date_start  = $request['date_start'];
  $date_end    = $request['date_end'];
  $reason      = $request['reason'];
  $card_number = $request['card_number'];
  $user_id     = $request['user_id'];

  $date_start = new \Datetime($date_start);
  $date_end = new \Datetime($date_end);

  $min_date = new \DateTime();
  $max_date = new \DateTime();
  $estimated_date = new \DateTime();
  $current_date = new \DateTime();

  $min_date->sub(new \DateInterval('P15D'));
  $max_date->sub(new \DateInterval('P1D'));

  if ($date_start < $min_date){
    Session::flash('min-date-error', 'Можно заказать детализацию не более чем за 2 недели до текущей даты');
    return redirect()->back();
  } elseif ($date_end >= $max_date) {
    Session::flash('max-date-error', 'Можно заказать детализацию не менее чем за 1 день до текущей даты');
    return redirect()->back();
  }

  $estimated_date = $estimated_date->add(new \DateInterval('P5D'));

  if ($request = DB::table('ETK_DETAILING_REQUEST')
    ->insert([
      'card_number' => $card_number,
      'date_start' => $date_start,
      'date_end' => $date_end,
      'reason' => $reason,
      'estimated' => $estimated_date,
      'user_id'  => $user_id,
      'status' => 1
      ])){
    Session::flash('request-sent-ok', 'Ваш запрос отправлен, мы рассмотрим его в течение 5 рабочих дней');
  return redirect()->back();
} else {
  Session::flash('request-sent-fail', 'Отправить запрос не удалось, повторите попытку позднее');
  return redirect()->back();
}
}

    /**
     * [sendNewPassword description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function sendNewPassword(Request $request){
      $this->validate($request,[
        'email' => 'required|email|max:255'
        ]);
      /**
       * INITIALIZE VARIABLES
       */
      $password_to_send = $this->generatePassword();
      $email = $request['email'];
      $confirmation_token = $request['_token'];
      $password = bcrypt($password_to_send);
      /**
       * FIND AND SAVE CONFIRMATION TOKEN
       * @var [type]
       */
      $user = \App\User::where('email',$email)->first();
      $user->confirmation_token = $confirmation_token;
      if ($user->save()){
       Mail::send('emails.send_new_password',
         [
         'password_to_send' => $password_to_send,
         'password' => $password,
         'confirmation_token' => $confirmation_token],
         function ($m) use ($email){
           $m->from('no-reply@etk21.ru', 'Служба поддержки ЕТК');
           $m->to($email)->subject('Восстановление доступа к личному кабинету');
         });
       Session::flash('link-sent', 'Вам было отправлено электронное письмо. Вам необходимо подтвердить изменение пароля.');
       return redirect()->back();
     } else {
       Session::flash('saving-fail', 'Что-то пошло не так... Попробуйте повторить позднее'); 
       return redirect()->back()->withInput();
     }
   }
    /**
 * CONFIRM PASSWORD CHANGING
 * @param  [type] $register_token [description]
 * @return [type]                 [description]
 */
    public function confirmNewPassword($confirmation_token,$password){
      $account = DB::table('users')
      ->where('confirmation_token',$confirmation_token)
      ->first();
      if ($account == NULL){
        Session::flash('confirmation-failed', 'Хмм.. Вашей заявки восстановления доступа не обнаружено');
        return redirect()->route('login');
      } else {
        DB::table('users')
        ->where('id', $account->id)
        ->update(['password' => $password, 'confirmation_token' => NULL]);
        Session::flash('confirmation-success', 'Ваш пароль успешно изменен');
        return redirect()->route('login');
      }
    }

    public function postChangeAvatar(Request $request){
      $this->validate($request, [
        'avatar' => 'required|mimes:jpg,jpeg,png'
        ]);
      $user_id = $request['user_id'];
      $avatar = $request->file('avatar');
      $file_extension = $request->file('avatar')->getClientOriginalExtension();
      $imagename = '/pictures/avatars/' . Auth::user()->id . '.' . $file_extension;
      if ($avatar){
        $user = \App\User::find($user_id);
        Storage::disk('public')->put($imagename, File::get($avatar));
        $user->profile_image = $imagename;
        $user->save();
        Session::flash('change-avatar-ok', 'Изображение профиля изменено');
      } else Session::flash('change-avatar-error', 'При загрузке изображения произошла ошибка');
      return redirect()->back();
    }
    /**
     * CHECK IF THE REQUESTED CARD WAS ALREADY ACTIVATED
     * @param  Request $request [description]
     * @return [type]           [description]
     */
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
