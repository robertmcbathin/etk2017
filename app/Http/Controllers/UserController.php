<?php

namespace App\Http\Controllers;
use Auth;
use DB;
use Session;
use \DateTime;
use \DateInterval;
use \SoapClient;
use \SoapServer;
use \SoapHeader;
use \SimpleXML;
use \SimpleXMLElement;
use Hash;
use Mail;
use App\Mail\ChangeEmail;
use App\Mail\SendNewPassword;
use Carbon\Carbon;
use \App\Log;
use \App\WsseAuthHeader;
use \App\Orders;
use Storage;
use File;
use \App\Http\Controllers\PaymentController;
use Illuminate\Http\Request;

class UserController extends Controller
{
  /**
   * СОЗДАНИЕ ПОДПИСИ
   * @param  [type] $Shop_IDP     [description]
   * @param  [type] $Order_IDP    [description]
   * @param  [type] $Subtotal_P   [description]
   * @param  [type] $MeanType     [description]
   * @param  [type] $EMoneyType   [description]
   * @param  [type] $Lifetime     [description]
   * @param  [type] $Customer_IDP [description]
   * @param  [type] $Card_IDP     [description]
   * @param  [type] $IData        [description]
   * @param  [type] $PT_Code      [description]
   * @param  [type] $password     [description]
   * @return [type]               [description]
   */
  private function getSignature( $Shop_IDP, $Order_IDP, $Subtotal_P, $MeanType, $EMoneyType,
    $Lifetime, $Customer_IDP, $Card_IDP, $IData, $PT_Code, $password ) {
    $Signature = strtoupper(
      md5(
        md5($Shop_IDP) . "&" .
        md5($Order_IDP) . "&" .
        md5($Subtotal_P) . "&" .
        md5($MeanType) . "&" .
        md5($EMoneyType) . "&" .
        md5($Lifetime) . "&" .
        md5($Customer_IDP) . "&" .
        md5($Card_IDP) . "&" .
        md5($IData) . "&" .
        md5($PT_Code) . "&" .
        md5($password)
        )
      );
    return $Signature;
  }
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
  
    public function checkCardOnRecoding($card_number){
      if($card_number){
        /**
         * PARSE ON SERIE AND NUM
         */
        $serie = substr($card_number,2,2);
        $num   = substr($card_number,4,6);
        /**
         * CHECK ON UEK SERIE
         */
        if($serie == 99){
            return response()->json([
                  'status' => 'error',
                  'errorCode' => '4',
                  'errorText' => 'Карты УЭК не поддерживаются'
              ],200);           
        }
        /**
         * CHECK OLD SB CARDS
         */
        if (($serie == 97) && ($num <= 552331)){
            return response()->json([
                  'status' => 'error',
                  'errorCode' => '5',
                  'errorText' => 'Устаревший тип карты БТК'
              ],200);           
        }
        /**
         * CHECK CARD ON EXISTING
         */
        $card = DB::table('ETK_CARDS')
              ->where('num',$card_number)
              ->first();
        if ($card){
          if ($card->is_recoded == 0){
               return response()->json([
                     'status' => 'error',
                     'errorCode' => '6',
                     'errorText' => 'Данная карта пока недоступна для пополнения онлайн. Пополните её хотя бы один раз.'
                 ],200);            
          } else {
            return response()->json([
                     'status' => 'success'
                 ],200);
          }
        } else {
             return response()->json([
                   'status' => 'error',
                   'errorCode' => '7',
                   'errorText' => 'Номер карты не существует. Проверьте правильность введенных данных'
               ],200);
        }

      } else {
        return response()->json([
                'status' => 'error',
                'errorCode' => '1',
                'errorText' => 'Не задан номер карты'
            ],200);
      }
    }

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
    /**  if (Session::has('current_card_number')){
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
      } else $trips = null;**/
      /**
       * GET ARTICLES
       * @var [type]
       */
      
      /**
       * NEWS
       * 
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
        'articles' => $articles
       // 'trips' => $trips
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
        $full_card_number_zero = '0100' . substr($full_card_number,4,6);
        if ($trips = DB::table('ETK_T_DATA')
          ->leftJoin('ETK_ROUTES','ETK_T_DATA.ID_ROUTE','=','ETK_ROUTES.id')
          ->select('ETK_T_DATA.CARD_NUM','ETK_T_DATA.DATE_OF', 'ETK_T_DATA.EP_BALANCE', 'ETK_T_DATA.AMOUNT', 'ETK_ROUTES.name', 'ETK_ROUTES.id_transport_mode as transport_type')
          ->where('ETK_T_DATA.CARD_NUM', $full_card_number)
     /**     ->orWhere('ETK_T_DATA.CARD_NUM', $full_card_number_zero)
          ->orWhere('ETK_T_DATA.CARD_NUM', substr($full_card_number,4,6)) **/
          ->orderBy('DATE_OF', 'DESC')
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
              case NULL:
              $trip->transport_type = 'refill32';
              break;
              default:
              $trip->transport_type = NULL;
              break;
            }
          if (($trip->name == NULL) && (strlen($trip->CARD_NUM) == 6)) $trip->name = 'Пополнение в Сбербанке';
         if (($trip->name == NULL) && (strlen($trip->CARD_NUM) > 6)) $trip->name = 'Пополнение в офисе';
          }
        } else $trips = null;
      } else {
        $trips = null;
        Session::flash('error','Вы не выбрали основную карту');
        return redirect()->back();
      }
      $last_update = DB::table('ETK_T_DATA')
                        ->orderBy('DATE_OF','desc')
                        ->first();
      $format_date = new \DateTime($last_update->DATE_OF);
      $last_update = $format_date->format('d.m.Y H:i:s');
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
        'trip_count' => $trip_count,
        'last_update' => $last_update
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
     * LASTNAME CHANGING
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function postChangeLastName(Request $request){
      $new_name = $request['lastname'];
      $user_id = $request['user_id'];
      $user = \App\User::find($user_id);
      $user->lastname = $new_name;
      if ($user->save()){
        Session::flash('success', 'Фамилия успешно изменена');
        return redirect()->back();
      } else {
       Session::flash('error', 'Изменить фамилию не удалось');
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
          /**
           * ПРОВЕРИТЬ, ДОБАВЛЕНА ЛИ УЖЕ КАРТА
           */
          if ($card_exist = DB::table('ETK_CARD_USERS')
            ->where('number',$card_number)
            ->where('user_id',$user_id)
            ->first() == true){
            Session::flash('error', 'Эта карта уже добавлена!');
          return redirect()->back();
        }
        $num   = substr($card_number, 0, 3);
          /**
           * LIMIT CARD COUNT TO 10
           * @var [type]
           */
          $usercard_count = DB::table('ETK_CARD_USERS')
          ->where('user_id', $user_id)
          ->count();
          if ($usercard_count > 10){
            Session::flash('error', 'Нельзя добавить более 10 карт на один аккаунт');
            return redirect()->back();
          }
          /**
           * [$card description]
           * @var [type]
           */
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
            case '029':
            $card_type = 15;
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
            case '069':
            $card_type = 16;
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

          if (($requested_card = \App\Card::where('num', $full_card_number)->first()) == NULL ){
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
         DB::table('ETK_CARD_USERS')
         ->where('user_id',$user_id)
         ->delete();
         return redirect()->route('register');
       } else {
        Session::flash('account-not-deleted', 'Удалить аккаунт не удалось');
        return redirect()->route('register');
      }
    }
    /**
     * [postBlockCard description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function postBlockCard(Request $request){
      $current_card = $request['current_card'];
      $user_id = $request['user_id'];
      $source = 2;
      $to_state = $request['to_state'];

      $serie = substr($current_card,1,2);
      $number = substr($current_card,3,6);
      if ($serie !== 99){ $prefix = '01'; } else {$prefix = '02';}
      $fullcard_number = $prefix . $serie . $number;
      $card = DB::table('ETK_CARDS')
      ->where('num', $fullcard_number)
      ->first();
      if ($card->state == 2){
        Session::flash('error','Данная карта уже заблокирована');
        return redirect()->back();
      }
      $chip = $card->chip;
      /**
       * CHECK ON EXISTING OF THE CARD IN BLOCKLIST
       */
      if ((DB::table('ETK_BLOCKLISTS')
        ->where('card_number', $fullcard_number)
        ->where('is_loaded', 0)
        ->first()) !== NULL){
        Session::flash('error','Данная карта уже стоит в очереди на блокировку');
      return redirect()->back();
    }
      /**
       * 
       */
      if (DB::table('ETK_BLOCKLISTS')
        ->insert(['card_number' => $fullcard_number,
          'chip' => $chip,
          'operation_type' => $to_state,
          'source' => 2,
          'created_by' => $user_id
          ]) && 
        DB::table('ETK_CARD_USERS')
        ->where('number', $current_card)
        ->update(['block_state' => 1])){
        Session::flash('success','Карта ' . $fullcard_number . ' успешно добавлена в блок-лист. Вы можете отменить блокировку до 18 часов текущего дня');
      session()->put('current_card_block_state', 1);
          /*
           * LOGGING CARD BLOCKING
           * 
            */
          $log = new \App\Log;
          $log->action_type = 11;
          $log->message = date('Y-m-d H:i:s') . " | Пользователь " . Auth::user()->username . " поставил карту #" . $fullcard_number . " в блокировочный список из личного кабинета";
          $log->save();
          /**
           * 
           */
          return redirect()->back();
        } else {
          Session::flash('error','Не удалось добавить карту в блок-лист. Напишите нам');
          return redirect()->back();
        }
      }
    /**
     * [postCancelBlockCard description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function postCancelBlockCard(Request $request){
      $current_card = $request['current_card'];
      $user_id = $request['user_id'];
      $source = 2;

      $serie = substr($current_card,1,2);
      $number = substr($current_card,3,6);
      if ($serie !== 99){ $prefix = '01'; } else {$prefix = '02';}
      $fullcard_number = $prefix . $serie . $number;


      if (($last_block_request = DB::table('ETK_BLOCKLISTS')
        ->where('card_number', $fullcard_number)
        ->orderBy('updated_at', 'DESC')
        ->first()) !== NULL){
        if ($last_block_request->is_loaded == 1){
          Session::flash('error','Снять карту с очереди на блокировку не удалось. Она уже загружена в блок-лист');
          return redirect()->back();
        }
      }

      if ((DB::table('ETK_BLOCKLISTS')
        ->where('card_number', $fullcard_number)
        ->where('is_loaded', 0)
        ->delete()) && 
        DB::table('ETK_CARD_USERS')
        ->where('number', $current_card)
        ->update(['block_state' => 0])){
        Session::flash('success','Карта ' . $fullcard_number . ' успешно снята с очереди на блокировку.');
      session()->put('current_card_block_state', 0);
            /*
           * LOGGING CANCEL CARD BLOCKING
           * 
            */
            $log = new \App\Log;
            $log->action_type = 12;
            $log->message = date('Y-m-d H:i:s') . " | Пользователь " . Auth::user()->username . " отменил блокировку карты #" . $fullcard_number . " из личного кабинета";
            $log->save();
          /**
           * 
           */
          return redirect()->back();
        } else {
          Session::flash('error','Что-то пошло не так. Снять карту с очереди на блокировку не удалось. Напишите нам');
          return redirect()->back();
        }
      }
    /**
     * [postBlockCard description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function postUnBlockCard(Request $request){
      $current_card = $request['current_card'];
      $user_id = $request['user_id'];
      $source = 2;
      $to_state = $request['to_state'];

      $serie = substr($current_card,1,2);
      $number = substr($current_card,3,6);
      if ($serie !== 99){ $prefix = '01'; } else {$prefix = '02';}
      $fullcard_number = $prefix . $serie . $number;
      $card = DB::table('ETK_CARDS')
      ->where('num', $fullcard_number)
      ->first();
      if ($card->state == 1){
        Session::flash('error','Данная карта не заблокирована');
        return redirect()->back();
      }
      $chip = $card->chip;
      /**
       * CHECK ON EXISTING OF THE CARD IN BLOCKLIST
       */
      if ((DB::table('ETK_BLOCKLISTS')
        ->where('card_number', $fullcard_number)
        ->where('is_loaded', 0)
        ->first()) !== NULL){
        Session::flash('error','Данная карта уже стоит в очереди на разблокировку');
      return redirect()->back();
    }
      /**
       * 
       */
      if (DB::table('ETK_BLOCKLISTS')
        ->insert(['card_number' => $fullcard_number,
          'chip' => $chip,
          'operation_type' => $to_state,
          'source' => 2,
          'created_by' => $user_id
          ]) && 
        DB::table('ETK_CARD_USERS')
        ->where('number', $current_card)
        ->update(['block_state' => 2])){
        Session::flash('success','Карта ' . $fullcard_number . ' успешно добавлена в деблок-лист. Вы не можете отменить разблокировку');
      session()->put('current_card_block_state', 2);
          /*
           * LOGGING CARD BLOCKING
           * 
            */
          $log = new \App\Log;
          $log->action_type = 13;
          $log->message = date('Y-m-d H:i:s') . " | Пользователь " . Auth::user()->username . " поставил карту #" . $fullcard_number . " в деблокировочный список из личного кабинета";
          $log->save();
          /**
           * 
           */
          return redirect()->back();
        } else {
          Session::flash('error','Не удалось добавить карту в деблок-лист. Напишите нам');
          return redirect()->back();
        }
      }
    /**
     * [postCancelBlockCard description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function postCancelUnBlockCard(Request $request){
      $current_card = $request['current_card'];
      $user_id = $request['user_id'];
      $source = 2;

      $serie = substr($current_card,1,2);
      $number = substr($current_card,3,6);
      if ($serie !== 99){ $prefix = '01'; } else {$prefix = '02';}
      $fullcard_number = $prefix . $serie . $number;

      if (($last_unblock_request = DB::table('ETK_BLOCKLISTS')
        ->where('card_number', $fullcard_number)
        ->orderBy('updated_at', 'DESC')
        ->first()) !== NULL){
        if ($last_unblock_request->is_loaded == 1){
          Session::flash('error','Снять карту с очереди на разблокировку не удалось. Она уже загружена в деблок-лист');
          return redirect()->back();
        }
      }

      if ((DB::table('ETK_BLOCKLISTS')
        ->where('card_number', $fullcard_number)
        ->where('is_loaded', 0)
        ->delete()) && 
        DB::table('ETK_CARD_USERS')
        ->where('number', $current_card)
        ->update(['block_state' => 0])){
        Session::flash('success','Карта ' . $fullcard_number . ' успешно снята с очереди на разблокировку.');
      session()->put('current_card_block_state', 0);
            /*
           * LOGGING CANCEL CARD BLOCKING
           * 
            */
            $log = new \App\Log;
            $log->action_type = 14;
            $log->message = date('Y-m-d H:i:s') . " | Пользователь " . Auth::user()->username . " отменил разблокировку карты #" . $fullcard_number . " из личного кабинета";
            $log->save();
          /**
           * 
           */
          return redirect()->back();
        } else {
          Session::flash('error','Что-то пошло не так. Снять карту с очереди на разблокировку не удалось. Напишите нам');
          return redirect()->back();
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
      * CANCEL_DISTRIBUTION
      */
     public function postCancelDistribution(Request $request){
      $user_id = $request->user_id;
      try {
        $user = \App\User::find($user_id);
        $user->is_email_receiver = 0;
        $user->save();        
      } catch (Exception $e) {
        Session::flash('error', $e);
        return redirect()->back();
      }
        Session::flash('success', 'Вы успешно отказались от рассылки');
        return redirect()->back();   
     }
     /**
      * ACCEPT DISTRIBUTION
      */
    public function postAcceptDistribution(Request $request){
      $user_id = $request->user_id;
      try {
        $user = \App\User::find($user_id);
        $user->is_email_receiver = 1;
        $user->save();        
      } catch (Exception $e) {
        Session::flash('error', $e);
        return redirect()->back();
      }
        Session::flash('success', 'Вы успешно подписались на рассылку');
        return redirect()->back();   
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
      session()->forget('block_state');
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
      session()->put('current_card_block_state', $card->block_state);
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

  $request_date_start  = $request['date_start'];
  $request_date_end    = $request['date_end'];
  $reason              = $request['reason'];
  $card_number         = $request['card_number'];
  $user_id             = $request['user_id'];

  if ($reason == ''){
    Session::flash('error','Необходимо обязательно указать причину');
    return redirect()->back();
  }
  $date_start = new \Datetime($request_date_start);
  $date_end = new \Datetime($request_date_end);

  $min_date = new \DateTime($request_date_end);
  $max_date = new \DateTime();
  $estimated_date = new \DateTime();
  $current_date = new \DateTime();

  $min_date->sub(new \DateInterval('P15D'));
  $max_date->sub(new \DateInterval('P1D'));
  if ($date_start >= $date_end){
    Session::flash('min-date-error', 'Вы указали начальную дату позже конечной');
    return redirect()->back();
  } elseif ($date_end >= $max_date) {
    Session::flash('max-date-error', 'Можно заказать детализацию не менее чем за 1 день до текущей даты');
    return redirect()->back();
  } elseif ($date_start < $min_date){
    Session::flash('min-date-error', 'Диапазон должен быть не более 14 дней');
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
            $this->setCurrentCard($card_number,$user_id);
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

    public function getTestBankCardPaymentPage(){
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
        $current_card = $this->modifyToFullNumber(Session::get('current_card_number'));

      } else {
        Session::flash('warning','Выберите карту для пополнения в меню');
        return redirect()->back();
      }

      /**
       * TEST RECODING
       */
      
      $recoding_response = $this->checkCardOnRecoding($current_card);
      $response = $recoding_response->getData();
      if ($response->status == 'error'){
        Session::flash('error',$response->errorText);
        return redirect()->back();
      }
      /**
       * PAYMENT SOAP CARDINFO
       * @var Payment
       */
      $client = new SoapClient('http://94.79.52.173:2180/SDPServer/SDPendpoints/SdpService.wsdl', array('soap_version'   => SOAP_1_1, 'trace' => true, 'location' => 'http://94.79.52.173:2180/SDPServer/SDPendpoints'));
      $params = array('agentId' => '1002', 
        'salepointId' => '1', 
        'version' => '1', 
        'sysNum' => $current_card, 
        'regionId' => 21, 
        'deviceId' => 'B2100003');

      $username = 'admin';
      $password = '1';
      $wsse_header = new WsseAuthHeader($username, $password);
      $client->__setSoapHeaders(array($wsse_header));
      try {
        $cardInfo = $client->__soapCall('CardInfo', array($params));
      } catch (Exception $e) {
        return redirect()->back();
      }
      if ((isset($cardInfo->CardInformation->warningMsg)) && (!isset($cardInfo->CardInformation->tariff))){
        Session::flash('warning', $cardInfo->CardInformation->warningMsg);
        return redirect()->back();
      } elseif ((isset($cardInfo->CardInformation->warningMsg)) && (isset($cardInfo->CardInformation->tariff))){
        Session::flash('warning', $cardInfo->CardInformation->warningMsg);
      }
      /**
       * CHECK CARD ON EXISTING
       * @var [type]
       */
      if ($cardInfo->Result->resultCode == 1000){
        Session::flash('error', $cardInfo->Result->resultCodeText);
        return redirect()->back();
      }
      /**
       * PREPARE DATA TO OUTPUT
       */
      $cardInfo->CardInformation->tariff->minSumInt = floor($cardInfo->CardInformation->tariff->minSumInt / 100);
      $cardInfo->CardInformation->tariff->maxSumInt = floor($cardInfo->CardInformation->tariff->maxSumInt / 100);
      /**
       * 
       */
      return view('pages.profile.test.bank_card_payment',[
        'cards' => $cards,
        'current_card' => $current_card,
        'cardInfo' => $cardInfo
        ]);
    }
    /**
     * [postPayByBankCard description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */



/**PAYMENT PRODUCTION
**
 * 
 */

 public function getPaymentPage(){
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

    public function getBankCardPaymentPage(){
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
        $current_card = $this->modifyToFullNumber(Session::get('current_card_number'));

      } else {
        Session::flash('warning','Выберите карту для пополнения в меню');
        return redirect()->back();
      }

      /**
       * TEST RECODING
       */
      
      $recoding_response = $this->checkCardOnRecoding($current_card);
      $response = $recoding_response->getData();
      if ($response->status == 'error'){
        Session::flash('error',$response->errorText);
        return redirect()->back();
      }
      /**
       * PAYMENT SOAP CARDINFO
       * @var Payment
       */
      $client = new SoapClient('http://94.79.52.173:2180/SDPServer/SDPendpoints/SdpService.wsdl', array('soap_version'   => SOAP_1_1, 'trace' => true, 'location' => 'http://94.79.52.173:2180/SDPServer/SDPendpoints'));
      $params = array('agentId' => '1002', 
        'salepointId' => '1', 
        'version' => '1', 
        'sysNum' => $current_card, 
        'regionId' => 21, 
        'deviceId' => 'B2100003');

      $username = 'admin';
      $password = '1';
      $wsse_header = new WsseAuthHeader($username, $password);
      $client->__setSoapHeaders(array($wsse_header));
      try {
        $cardInfo = $client->__soapCall('CardInfo', array($params));
      } catch (Exception $e) {
        return redirect()->back();
      }
      if ((isset($cardInfo->CardInformation->warningMsg)) && (!isset($cardInfo->CardInformation->tariff))){
        Session::flash('warning', $cardInfo->CardInformation->warningMsg);
        return redirect()->back();
      } elseif ((isset($cardInfo->CardInformation->warningMsg)) && (isset($cardInfo->CardInformation->tariff))){
        Session::flash('warning', $cardInfo->CardInformation->warningMsg);
      }
      /**
       * CHECK CARD ON EXISTING
       * @var [type]
       */
      if ($cardInfo->Result->resultCode == 1000){
        Session::flash('error', $cardInfo->Result->resultCodeText);
        return redirect()->back();
      }
      /**
       * PREPARE DATA TO OUTPUT
       */
      $cardInfo->CardInformation->tariff->minSumInt = floor($cardInfo->CardInformation->tariff->minSumInt / 100);
      $cardInfo->CardInformation->tariff->maxSumInt = floor($cardInfo->CardInformation->tariff->maxSumInt / 100);
      /**
       * 
       */
      return view('pages.profile.bank_card_payment',[
        'cards' => $cards,
        'current_card' => $current_card,
        'cardInfo' => $cardInfo
        ]);
    }
    /**
     * [postPayByBankCard description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function postPayByBankCard(Request $request){
      $this->validate($request,[

        ]);
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
      if (!is_int($request->payment_value * 100)){
        Session::flash('error','Введенная сумма не является целым числом');
        return redirect()->back();
      }

      $payment_value       = $request->payment_value;
      $payment_session_id  = $request->payment_session_id;
      $payment_tariff_id   = $request->payment_tariff_id;
      $payment_max_sum     = $request->max_sum;
      $payment_min_sum     = $request->min_sum;
      $payment_to_acquirer = ($payment_value * 1.03);
      $comission           = ($payment_value * 0.03);
      $user_id             = $request->user_id;
      $card_number         = $request->card_number;

      /**
       * SAVE SESSION ID TO LOCAL SESSION
       */
      Session::put('payment_value', $payment_value);
      /**
       * VERIFY INPUTS
       */
      if ($payment_value < $payment_min_sum){
        Session::flash('error','Введенная сумма меньше минимально возможной');
        return redirect()->back();       
      }
      if ($payment_value > $payment_max_sum){
        Session::flash('error','Введенная сумма больше максимально возможной');
        return redirect()->back();       
      }
      /**
       * 
       */
      /**
       * GET USER DATA
       */
      $user = \App\User::find($user_id);
      $email = $user->email;
      /**
       * 
       */
      /**
       * CREATE AN ORDER
       */
      $Order_ID = 'Uniteller-u' . $user_id . '-c' . $card_number . '-' . date('YmdHis');
      $order = new \App\Order;
      $order->user_id = $user_id;
      $order->order_type = 1;
      $order->payment_to_acquirer = $payment_to_acquirer;
      $order->payment_to_card = $payment_value;
      $order->card_number = $card_number;
      $order->order_name = $Order_ID;
      $order->session_id = $payment_session_id;
      $order->tariff_id = $payment_tariff_id;
      $order->save();
      /**
       * 
       */
      $Shop_IDP = '00011986';
      $Lifetime = 3600;
      $Subtotal_P = $payment_to_acquirer;
      $Customer_IDP = $user_id;
      $URL_RETURN_OK = 'https://etk21.ru/payment/ok/';
      $URL_RETURN_NO = 'https://etk21.ru/payment/fail/';
      $password = 'tusk1oAqfMc8NdYpybGvJFSnsx6UyGbYfIRTQ5m4ocIQjLaGBWYb9sZwf0wjsUHpk0LlT6g55L1iiIHN';
      $EMoneyType = '';
      $MeanType = '';
      $Card_IDP = '';
      $PT_Code = '';

      $Signature = $this->getSignature( $Shop_IDP, $Order_ID, $Subtotal_P, $MeanType, $EMoneyType,
$Lifetime, $Customer_IDP, "", "", "", $password );

      
      return view('pages.profile.bank_card_payment_confirm',[
        'cards' => $cards,
        'current_card' => $card_number,
        'Order_IDP' => $Order_ID,
        'Shop_IDP' => $Shop_IDP,
        'Lifetime' => $Lifetime,
        'Subtotal_P' => $Subtotal_P,
        'Customer_IDP' => $Customer_IDP,
        'Signature' => $Signature,
        'URL_RETURN_OK' => $URL_RETURN_OK,
        'URL_RETURN_NO' => $URL_RETURN_NO,
        'payment_to_card' => $payment_value,
        'comission' => $comission,
        'payment_to_acquirer' => $payment_to_acquirer,
        'email' => $email,
        ]);
      
    }
    /**
     * [getPaymentOkPage description]
     * @return [type] [description]
     */
    public function getPaymentOkPage($Order_ID){
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
       * SEARCH ORDER BY NAME
       */
      if ($order = DB::table('ETK_ORDERS')
            ->where('order_name',$Order_ID)
            ->first()){
        /**
         * ЗАКАЗ НАЙДЕН
         */
        if ($order->rewrite_status == 1){ //ЕСЛИ КАРТА УЖЕ ПЕРЕЗАПИСАНА
          Session::flash('error','Отложенное пополнение по этому заказу уже создано');
          return view('pages.profile.payment.payment_ok',[
        'cards' => $cards,
        'current_card' => $current_card]);
        } elseif ($order->rewrite_status == 0) { //КАРТА НЕ ПЕРЕЗАПИСАНА. МОЖНО СОЗДАВАТЬ ТРАНЗАКЦИЮ
        /**
         * POST TRANSACTION
         */
        try {
          $client = new SoapClient('http://94.79.52.173:2180/SDPServer/SDPendpoints/SdpService.wsdl', array('soap_version'   => SOAP_1_1, 'trace' => true, 'location'   => 'http://94.79.52.173:2180/SDPServer/SDPendpoints'));
          $params = array('agentId' => '1002', 
            'salepointId' => '1', 
            'version' => '1', 
            'sessionId' => $order->session_id,
            'tariffId' => $order->tariff_id,
            'paymentSum' => ($order->payment_to_card*100),
            'paymentInfo' => 'Uniteller'
          );
          $username = 'admin';
          $password = '1';
          $wsse_header = new WsseAuthHeader($username, $password);
          $client->__setSoapHeaders(array($wsse_header));
          $paymentInfo = $client->__soapCall('CardPayment', array($params)); 
          /**
           * UPDATE DB
           */
          DB::table('ETK_ORDERS')
            ->where('order_name', $Order_ID)
            ->update([
              'rewrite_status' => 1
              ]);
        } catch (Exception $e) {
          return view('pages.profile.payment.payment_fail',[
        'cards' => $cards,
        'current_card' => $current_card]);
        }
        Session::flash('success','Операция прошла успешно!');
        return view('pages.profile.payment.payment_ok',[
        'cards' => $cards,
        'current_card' => $current_card]);          
        }
        
      } else {
        Session::flash('error','Заказ с таким номером не существует');
        return view('pages.profile.payment.payment_ok',[
        'cards' => $cards,
        'current_card' => $current_card]);
      }
      return view('pages.profile.payment.payment_ok',[
        'cards' => $cards,
        'current_card' => $current_card]);
    }

    public function getPaymentFailPage(){

    }
  }