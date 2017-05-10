<?php

namespace App\Http\Controllers;
use Auth;
use DB;
use Session;
use \DateTime;
use Hash;
use Mail;
use Carbon\Carbon;
use \App\Log;
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
      $num   = substr(Auth::user()->card_number, 3, 6);
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
        return view('pages.profile',[
            'operations' => $operations,
            'last_import' => $last_import
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
     * CHANGE PASSWORD
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function postDeleteAccount(Request $request){
      $user_id         = $request['user_id'];
      $user = \App\User::find($user_id);
      if ($user->delete()){
         Session::flush();
         Session::flash('account-deleted', 'Аккаунт удален');
         return redirect()->route('register');
      } else {
        Session::flash('account-not-deleted', 'Удалить аккаунт не удалось');
        return redirect()->route('register');
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
                ->update(['password' => $password, 'confirmation_token' => NULL]);
            Session::flash('confirmation-success', 'Ваш пароль успешно изменен');
            return redirect()->route('login');
        }
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
