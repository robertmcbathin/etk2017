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
use App\Mail\SendNewPassword;
use Carbon\Carbon;
use \App\Log;
use Storage;
use File;
use Illuminate\Http\Request;

class UserController extends Controller
{
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
        Session::put('user_id',Auth::user()->id);
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
      if (Session::has('current_card_number')){
        $full_card_number = $this->modifyToFullNumber(Session::get('current_card_number'));
        if ($trips = DB::table('ETK_T_DATA')
                    ->leftJoin('ETK_ROUTES','ETK_T_DATA.ID_ROUTE','=','ETK_ROUTES.id')
                    ->select('ETK_T_DATA.DATE_OF', 'ETK_T_DATA.EP_BALANCE', 'ETK_T_DATA.AMOUNT', 'ETK_ROUTES.name', 'ETK_ROUTES.id_transport_mode as transport_type')
                    ->where('ETK_T_DATA.CARD_NUM', $full_card_number)
                    ->orderBy('DATE_OF', 'DESC')
                    ->limit(15)
                    ->get()){
          foreach ($trips as $trip){
            $trip->DATE_OF = new \Datetime($trip->DATE_OF);
            $trip->DATE_OF = date_format($trip->DATE_OF,'d.m.Y H:i:s');
            switch ($trip->transport_type) {
              case 600013467:
                $trip->transport_type = 'M32';
                break;
              case 400013467:
                $trip->transport_type = 'A32';
                break;
              case 200013467:
                $trip->transport_type = 'T32';
                break;
              default:
                $trip->transport_type = NULL;
                break;
            }
            if ($trip->name == NULL) {$trip->name = 'Пополнение'; $trip->transport_type = 'refill32';};
          }
        } else $trips = null;
      } else $trips = null;
      /**
       * GET ARTICLES
       * @var [type]
       */
      $articles = DB::table('ETK_ARTICLES')
       ->orderBy('created_at', 'desc')
       ->take(3)
       ->get();
       Carbon::setLocale('ru');
       foreach ($articles as $article) {
          $non_formatted_date = new Carbon($article->created_at);
          $date = $non_formatted_date->diffForHumans();
          $article->created_at = $date;
      }
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
        'current_card' => $current_card,
        'articles' => $articles,
        'trips' => $trips
     //   'card_count' => $card_count
        ]);
     }
    /**
     * [showDepositPage description]
     * @return [type] [description]
     */
    public function showPaymentPage(){
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
      return view('pages.profile.payment',[
        'cards' => $cards,
        'current_card' => $current_card]);
    }


    /**
     * [showDepositHistory description]
     * @return [type] [description]
     */
    public function showPaymentHistory(){
      $num   = substr(Session::get('current_card_number'),3,6);
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
            return view('pages.profile.payment_history',
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
      /**
       * GET DETAILING REQUESTS
       * @var [type]
       */
      $requests = DB::table('ETK_DETAILING_REQUEST')
      ->where('user_id',Auth::user()->id)
      ->where('card_number', Session::get('current_card_number'))
      ->orderBy('created_at', 'DESC')
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
 * [showDetailsHistory description]
 * @return [type] [description]
 */
public function showDetailsReport(){
      /**
       * GET DETAILING REQUESTS
       * @var [type]
       */
      if (Session::has('current_card_number')){
        $full_card_number = $this->modifyToFullNumber(session()->get('current_card_number'));
        if ($trips = DB::table('ETK_T_DATA')
                    ->leftJoin('ETK_ROUTES','ETK_T_DATA.ID_ROUTE','=','ETK_ROUTES.id')
                    ->select('ETK_T_DATA.DATE_OF', 'ETK_T_DATA.EP_BALANCE', 'ETK_T_DATA.AMOUNT', 'ETK_ROUTES.name', 'ETK_ROUTES.id_transport_mode as transport_type')
                    ->where('ETK_T_DATA.CARD_NUM', $full_card_number)
                    ->orderBy('DATE_OF', 'DESC')
                    ->paginate(15)){
          foreach ($trips as $trip){
            $trip->DATE_OF = new \Datetime($trip->DATE_OF);
            $trip->DATE_OF = date_format($trip->DATE_OF,'d.m.Y H:i:s');
            switch ($trip->transport_type) {
              case 600013467:
                $trip->transport_type = 'M32';
                break;
              case 400013467:
                $trip->transport_type = 'A32';
                break;
              case 200013467:
                $trip->transport_type = 'T32';
                break;
              default:
                $trip->transport_type = NULL;
                break;
            }
            if ($trip->name == NULL) {$trip->name = 'Пополнение'; $trip->transport_type = 'refill32';};
          }
        } else $trips = null;
      } else $trips = null;
      /**
       * [$cards description]
       * @var [type]
       */

      $vehicle_chart = DB::table('ETK_T_DATA')
          ->join('ETK_ROUTES','ETK_T_DATA.ID_ROUTE','=','ETK_ROUTES.id')
          ->selectRaw('count(ETK_ROUTES.id_transport_mode) as transport_type, sum(ETK_T_DATA.AMOUNT) as amount, ETK_ROUTES.id_transport_mode')
          ->where('ETK_T_DATA.CARD_NUM', $full_card_number)
          ->groupBy('ETK_ROUTES.id_transport_mode')
          ->get();
      $trip_count = 0;
      foreach ($vehicle_chart as $certain_vehicle) {
        $trip_count += $certain_vehicle->transport_type;
        switch ($certain_vehicle->id_transport_mode) {
          case 600013467:
            $certain_vehicle->id_transport_mode = 'Пригородный автобус';
            break;
          case 400013467:
            $certain_vehicle->id_transport_mode = 'Автобус и МТ';
            break;
          case 200013467:
            $certain_vehicle->id_transport_mode = 'Троллейбус';
            break;
          default:
            $certain_vehicle->id_transport_mode = 'Неизвестно';
            break;
        }
      }
      foreach ($vehicle_chart as $certain_vehicle) {
        $certain_vehicle->transport_type = ($certain_vehicle->transport_type/$trip_count)*100;
        $certain_vehicle->transport_type = round($certain_vehicle->transport_type);
      }
      /**
       * 
       * 
       */
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
      return view('pages.profile.details_report',
        ['trips' => $trips,
        'cards' => $cards,
        'current_card' => $current_card,
        'vehicle_chart' => $vehicle_chart,
        'trip_count' => $trip_count
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
      ->select('ETK_CARD_USERS.*', 'ETK_CARD_TYPES.name as name', 'ETK_CARD_TYPES.category as category')
      ->get();
      $current_card = DB::table('ETK_CARD_USERS')
      ->join('ETK_CARD_TYPES', 'ETK_CARD_USERS.card_image_type', '=', 'ETK_CARD_TYPES.id')
      ->where('ETK_CARD_USERS.user_id', Auth::user()->id)
      ->select('ETK_CARD_USERS.*', 'ETK_CARD_TYPES.name as name')
      ->first();
      $card_types = DB::table('ETK_CARD_TYPES')
                      ->get();
      return view('pages.profile.settings',[
        'cards' => $cards,
        'current_card' => $current_card,
        'card_types' => $card_types
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
            case '036':
            $card_type = 9;
            break;
            case '037':
            $card_type = 10;
            break;
            case '040':
            $card_type = 7;
            break;
            case '041':
            $card_type = 7;
            break;
            case '43':
            $card_type = 5;
            break;
            case '44':
            $card_type = 8;
            break;
            case '097':
            $card_type = 4;
            break;
            case '099':
            $card_type = 12;
            break;

            default:
            Session::flash('error', 'Данную серию карт нельзя добавить!');
            return redirect()->back();
            break;
          }

          /**
           * CHECK CARD ON EXISTING
           */
          $full_card_number = $this->modifyToFullNumber($card_number);

          if (($card = \App\Card::where('num', $full_card_number)->first()) == NULL ){
            Session::flash('error', 'Данной карты не существует. Если Вы уверены в обратном, свяжитесь с нами.');
            return redirect()->back();            
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
    public function postBlockCard(Request $request){

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
      /**
       * FORGET OLD VARIABLES
       */
      session()->forget('current_card_number');
      session()->forget('current_card_image_type');
      session()->forget('current_balance');
      session()->forget('current_card_last_transaction');
      session()->forget('current_card_kind');
      session()->forget('current_card_state');
      session()->forget('verified');
      $card = DB::table('ETK_CARD_USERS')
      ->join('ETK_CARD_TYPES', 'ETK_CARD_USERS.card_image_type', '=', 'ETK_CARD_TYPES.id')
      ->where('ETK_CARD_USERS.user_id', Auth::user()->id)
      ->where('ETK_CARD_USERS.number', $current_card)
      ->select('ETK_CARD_USERS.*', 'ETK_CARD_TYPES.name as name')
      ->first();
      /**
       * SET CARD NUMBER
       */
      session()->put('current_card_number', $current_card);
      /**
       * get database card number
       * @var [type]
       */
      $full_card_number = $this->modifyToFullNumber($current_card);
      if ($card_info = DB::table('ETK_CARDS')
                    ->where('num', $full_card_number )
                    ->first()){
        session()->put('current_card_balance', $card_info->ep_balance_fact);
        $non_formatted_date = new \DateTime($card_info->date_of_travel_doc_kind_last);
        $last_transaction = $non_formatted_date->format('d.m.Y H:i:s');
        session()->put('current_card_last_transaction', $last_transaction);
        session()->put('current_card_verified', $card->verified);
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
         * CARD STATE : Состояние карты(1-в обращении, 2-в блок списке, 3-заблокирована, 4-в деблок списке, 5-изъята, 6-чужая в блок, 7-чужая из блок, 8-Заблокирована по списку терминалов)
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
      } else {
        session()->put('current_card_balance', '0');
        session()->put('current_card_last_transaction', 'Информация о последней транзакции отсутствует');
      }
      session()->put('current_card_image_type', '/pictures/cards/thumbnails/160/' . $card->card_image_type . '.png');
      return redirect()->back();         
    }

    /**
     * [getConfirmEmailChanging description]
     * @param  [type] $token [description]
     * @return [type]        [description]
     */
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
      $user = \App\User::where('email',$email)->first();
      $user_id = $user->id;
      /**
       * FIND AND SAVE CONFIRMATION TOKEN
       * @var [type]
       */
      DB::transaction(function() use ($email,$confirmation_token,$user_id, $password){
            DB::table('users')
              ->where('email',$email)
              ->update(['confirmation_token' => $confirmation_token]);
            DB::table('ETK_TEMP_PASSWORDS')
              ->insert(['user_id' => $user_id, 
                        'password' => $password
            ]);  
      });
        Mail::to($request->email)->send(new SendNewPassword($password_to_send, $password, $confirmation_token, $user_id));
        if (DB::table('ETK_TEMP_PASSWORDS')
              ->where('user_id', $user_id)
              ->first()){
         Session::flash('reset-link-sent', 'Вам было отправлено электронное письмо. Вам необходимо подтвердить изменение пароля.');
         return redirect()->back();
        } else {
         Session::flash('saving-fail', 'Что-то пошло не так... Попробуйте повторить позднее');
         return redirect()->back()->withInput();
        }
       Session::flash('link-sent', 'Вам было отправлено электронное письмо. Вам необходимо подтвердить изменение пароля.');
       return redirect()->back();
   }
    /**
 * CONFIRM PASSWORD CHANGING
 * @param  [type] $register_token [description]
 * @return [type]                 [description]
 */
    public function confirmNewPassword($confirmation_token,$user_id){
      $account = DB::table('users')
                    ->where('confirmation_token',$confirmation_token)
                    ->first();
      if ($account == NULL){
        Session::flash('confirmation-failed', 'Хмм.. Вашей заявки восстановления доступа не обнаружено');
        return redirect()->route('login');
      } else {
        DB::transaction(function() use ($user_id,$account){
          $new_password = DB::table('ETK_TEMP_PASSWORDS')
              ->where('user_id',$user_id)
              ->first();
          DB::table('users')
            ->where('id', $account->id)
            ->update(['password' => $new_password->password, 'confirmation_token' => NULL]);
          DB::table('ETK_TEMP_PASSWORDS')
             ->where('user_id',$user_id)
             ->delete();
        });
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
     * [postChangeCardImage description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function postChangeCardImage(Request $request){
      $card_image_type = $request['card_image_type'];
      $card_number     = $request['card_number'];
      $user_id         = $request['user_id'];
      if (DB::table('ETK_CARD_USERS')
            ->where('user_id', $user_id)
            ->where('number',$card_number)
            ->update(['card_image_type' => $card_image_type])){
        Session::flash('change_card_image_ok', 'Изображение карты успешно изменено');
        return redirect()->back();
      } else {
        Session::flash('change_card_image_fail', 'Упс... Изображение карты изменить не удалось');
        return redirect()->back();
      }
    }
    /**
     * [postVerifyCard description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function postVerifyCard(Request $request){
      $chip = $request['chip'];
      $user_id = $request['user_id'];
      $card_number = $request['number'];

      $full_card_number = $this->modifyToFullNumber($card_number);
      if ($card = DB::table('ETK_CARDS')
          ->where('num', $full_card_number)
          ->first()){
        if ($chip_from_db = substr($card->chip,0,8)){
          if ($chip == $chip_from_db) {
            DB::table('ETK_CARD_USERS')
              ->where('user_id', $user_id)
              ->where('number', $card_number)
              ->update(['verified' => 1]);
              Session::flash('verified-ok', 'Карта успешно подтверждена!');
              return redirect()->back();
          } else {
            Session::flash('verified-fail', 'Коды не совпадают!');
            return redirect()->back();
          }
        } else return redirect()->back();
      } else {
          Session::flash('verified-card-search-fail', 'Такая карта не найдена!');
          return redirect()->back();
      }
      if ($chip_from_db = substr($card->chip,0,8)){
        if ($chip == $chip_from_db) {
          DB::table('ETK_CARD_USERS')
            ->where('user_id', $user_id)
            ->where('number', $card_number)
            ->update(['verified' => 1]);
            Session::flash('verified-ok', 'Карта успешно подтверждена!');
            return redirect()->back();
        } else {
          Session::flash('verified-fail', 'Коды не совпадают!');
          return redirect()->back();
        }
      } else return redirect()->back();
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



    /**
     * [showDepositPage description]
     * @return [type] [description]
     */
    public function getTestPaymentPage(){
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
      return view('pages.profile.test.payment',[
        'cards' => $cards,
        'current_card' => $current_card]);
    }
  }