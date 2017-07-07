<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Session;
use CsvReader;
use Mail;
use \App\Online;
use \DateTime;
use \App\Log;
use \App\Article;
use \App\Question;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SudoController extends Controller
{
  public function getDashboard(){
   $questions = new Question;
   $questions_count = $questions->count();
   $waiting_for_activation = DB::table('users')
                               ->where('register_token','!=',NULL)
                               ->count();
   $users_count = DB::table('users')
                    ->count();
  $new_detailing_requests_count = DB::table('ETK_DETAILING_REQUEST')
                              ->where('status',1)
                              ->count();
   return view('sudo.pages.dashboard',[
    'questions_count' => $questions_count,
    'waiting_for_activation' => $waiting_for_activation,
    'users_count' => $users_count,
    'new_detailing_requests_count' => $new_detailing_requests_count
    ]);
 }
 public function getArticlesPage(){
   $articles = DB::table('ETK_ARTICLES')
   ->join('users','users.id','=','ETK_ARTICLES.user')
   ->select('ETK_ARTICLES.*','users.name as author')
   ->orderBy('id','desc')  
   ->paginate(10);	
   return view('sudo.pages.articles',[
    'articles' => $articles
    ]);
 }
 public function togglePublishedCheckbox(Request $request){
  return response()->json(['message' => $request['checkbox']]);
}
public function getAddArticle(){
  return view('sudo.pages.add_article');
}
public function postAddArticle(Request $request){
  $this->validate($request,[
    'title' => 'required|min:1|max:100',
    'description' => 'required|min:1|max:255',
    'content' => 'required|min:1|max:4096'
    ]);
  /* dd($request);*/
  $article = new Article;
        /**
         * DEFAULT
         */
        $article->published = 0;
        /**
         * 
         */
        $article->title = $request['title'];
        $article->description = $request['description'];
        $article->content = $request['content'];
        if (isset($request['published'])) $article->published = $request['published'];
        $article->user = Auth::user()->id;
        $image = $request->file('image');
        $imagename = '/pictures/articles/' . date('Ymd-His') . '.jpg';
        if ($image){
          Storage::disk('public')->put($imagename, File::get($image));
          Session::flash('add-article-ok', 'Новость сохранена');
          $article->image = $imagename;
          $article->save();
        } else Session::flash('add-article-error', 'Ошибка');
        return redirect()->back();
      }
      public function getEditArticle($id){
        $article = DB::table('ETK_ARTICLES')
        ->where('id',$id)
        ->first();
        return view('sudo.pages.edit_article',[
          'article' => $article
          ]);
      }

      public function postEditArticle(Request $request){
        $this->validate($request,[
          'title' => 'required|min:1|max:100',
          'description' => 'required|min:1|max:255',
          'content' => 'required|min:1|max:4096'
          ]);
        /* dd($request);*/
        $article = Article::find($request['id']);
        /**
         * DEFAULT
         */
        $article->published = 0;
        /**
         * 
         */
        $article->id = $request['id'];
        $article->title = $request['title'];
        $article->description = $request['description'];
        $article->content = $request['content'];
        if (isset($request['published'])) $article->published = $request['published'];
        $article->user = Auth::user()->id;
        if ($request->file('image') !== null){
          $image = $request->file('image');
          $imagename = '/pictures/articles/' . date('Ymd-His') . '.jpg';
          if ($image){
            Storage::disk('public')->put($imagename, File::get($image));
            $article->image = $imagename;
            $article->save();
            Session::flash('add-article-ok', 'Новость сохранена');
          }};
          if ($article->save() !== null){
            Session::flash('add-article-ok', 'Новость сохранена');
          } else Session::flash('add-article-error', 'Ошибка');
          return redirect()->back();
        }
        public function postDeleteArticle($id){
          $article = Article::find($id);
          $article->delete();
          return redirect()->back();
        }

    /**
     * QUESTIONS
     */
    public function getQuestionsPage(){
      $questions = DB::table('ETK_QUESTIONS')
      ->orderBy('created_at','desc')  
      ->paginate(10);   
      return view('sudo.pages.questions',[
        'questions' => $questions
        ]);
    }
      /**
     * DETAILING REQUESTS
     */
      public function getDetailingRequestsPage(){
        $requests = DB::table('ETK_DETAILING_REQUEST')
        ->orderBy('created_at')
        ->paginate(10);
        return view('sudo.pages.detailing_requests',[
          'requests' => $requests
          ]); 
      }
      public function getOperationsPage(){
        $last_import = DB::table('SB_DEPOSIT_IMPORTS')
        ->orderBy('created_at', 'DESC')
        ->first(); 
        $last_import->created_at = new \DateTime($last_import->created_at);
        $last_import->created_at = date_format($last_import->created_at,'d.m.Y H:i:s');
        return view('sudo.pages.operations', [
          'last_import' => $last_import
          ]);
      }

      public function getImportPage(){
        $last_import = DB::table('SB_DEPOSIT_IMPORTS')
        ->orderBy('created_at', 'DESC')
        ->first(); 
        $last_import->created_at = new \DateTime($last_import->created_at);
        $last_import->created_at = date_format($last_import->created_at,'d.m.Y H:i:s');

        if ($last_card_update = DB::table('ETK_CARDS_UPDATES')
        ->orderBy('created_at', 'DESC')
        ->first()){
          $last_card_update->created_at = new \DateTime($last_card_update->created_at);
          $last_card_update->created_at = date_format($last_card_update->created_at,'d.m.Y H:i:s');
        }
        $last_trip_date = DB::table('ETK_T_DATA')
                            ->orderBy('DATE_OF', 'DESC')
                            ->first();
        $sb_imports_list = DB::table('SB_DEPOSIT_IMPORTS')
                              ->join('users', 'SB_DEPOSIT_IMPORTS.created_by', '=', 'users.id')
                              ->select('SB_DEPOSIT_IMPORTS.id', 'SB_DEPOSIT_IMPORTS.created_at', 'SB_DEPOSIT_IMPORTS.transaction_count','users.name as created_by')
                              ->orderBy('created_at', 'desc')
                              ->limit(5)
                              ->get();
        $card_updates_list = DB::table('ETK_CARDS_UPDATES')
                              ->join('users', 'ETK_CARDS_UPDATES.created_by', '=', 'users.id')
                              ->select('ETK_CARDS_UPDATES.id', 'ETK_CARDS_UPDATES.created_at', 'ETK_CARDS_UPDATES.transaction_count','users.name as created_by')
                              ->orderBy('created_at', 'desc')
                              ->limit(5)
                              ->get();
        $trip_imports_list = DB::table('ETK_T_DATA_IMPORTS')
                              ->join('users', 'ETK_T_DATA_IMPORTS.created_by', '=', 'users.id')
                              ->select('ETK_T_DATA_IMPORTS.id', 'ETK_T_DATA_IMPORTS.created_at', 'ETK_T_DATA_IMPORTS.transaction_count','users.name as created_by')
                              ->orderBy('created_at', 'desc')
                              ->limit(5)
                              ->get();
        return view('sudo.pages.import', [
          'last_import' => $last_import,
          'last_card_update' => $last_card_update,
          'sb_imports_list' => $sb_imports_list,
          'card_updates_list' => $card_updates_list,
          'trip_imports_list' => $trip_imports_list,
          'last_trip_date' => $last_trip_date->DATE_OF
          ]);
      }
      /**
       * SETTINGS
       * @param  Request $request [description]
       * @return [type]           [description]
       */
      public function getSchoolsPage(){
        $schools = DB::table('ETK_PRIVILEGE')
                    ->orderBy('code')
                    ->paginate(25);
        return view('sudo.pages.schools', [
              'schools' => $schools
          ]);
      }
      /**
       * [getOperationsPage description]
       * @return [type] [description]
       */
      public function getCardBlockingPage(){

        $today_office_blocklist = DB::table('ETK_BLOCKLISTS')
                              ->join('users', 'ETK_BLOCKLISTS.created_by', '=', 'users.id')
                              ->select('ETK_BLOCKLISTS.id','ETK_BLOCKLISTS.card_number','ETK_BLOCKLISTS.chip','ETK_BLOCKLISTS.operation_type','users.name as created_by', 'ETK_BLOCKLISTS.created_at','ETK_BLOCKLISTS.is_loaded')
                              ->where('ETK_BLOCKLISTS.is_loaded', 0)
                              ->where('ETK_BLOCKLISTS.source', 1)
                              ->get();
        $today_profile_blocklist = DB::table('ETK_BLOCKLISTS')
                              ->join('users', 'ETK_BLOCKLISTS.created_by', '=', 'users.id')
                              ->select('ETK_BLOCKLISTS.id','ETK_BLOCKLISTS.card_number','ETK_BLOCKLISTS.chip','ETK_BLOCKLISTS.operation_type','users.name as created_by', 'ETK_BLOCKLISTS.created_at','ETK_BLOCKLISTS.is_loaded')
                              ->where('ETK_BLOCKLISTS.is_loaded', 0)
                              ->where('ETK_BLOCKLISTS.source', 2)
                              ->get();
        $statuscard_lists = DB::table('ETK_STATUSCARDS')
                              ->join('users','ETK_STATUSCARDS.created_by','=','users.id')
                              ->select('ETK_STATUSCARDS.id', 'ETK_STATUSCARDS.status_count', 'ETK_STATUSCARDS.filename', 'users.name', 'ETK_STATUSCARDS.created_at')
                              ->get();                        
        return view('sudo.pages.card-blocking', [
          'today_office_blocklist' => $today_office_blocklist,
          'today_profile_blocklist' => $today_profile_blocklist,
          'statuscard_lists' => $statuscard_lists
          ]);
      }
      /**
       * [postRemoveFromBlocklist description]
       * @param  Request $request [description]
       * @return [type]           [description]
       */
      public function postRemoveFromBlocklist(Request $request){
        $chip = $request['chip'];
        if (DB::table('ETK_BLOCKLISTS')
              ->where('chip',$chip)
              ->delete()){
          Session::flash('item-removed-success', 'Позиция успешкно удалена');
          return redirect()->back();
        } else {
          Session::flash('item-removed-fail', 'Удалить элемент не удалось');
          return redirect()->back();
        }
      }
      /**
       * [postImportTransactions description]
       * 
       */
      public function postImportSBTransactions(Request $request){
        $transactions = $request->file('sb-transaction');
        $transaction_name = '/admin/files/transactions/SB_TRANSACTION_'  . date('Ymd-His') . '.csv';
        if ($request->file('sb-transaction')->isValid()){
          Storage::disk('public')->put($transaction_name, File::get($transactions));
          $reader = CsvReader::open($transactions);
          $counter = 0;
          while (($line = $reader->readLine()) !== false) {
            try {
              $transaction_date = date_create_from_format('d.m.Y', $line[1]);
              if (strlen($line[4] == 5)) $line[4] = '0' . $line[4];
              if (strlen($line[4] == 4)) $line[4] = '00' . $line[4];
              if (strlen($line[4] == 3)) $line[4] = '000' . $line[4];
              DB::table('SB_DEPOSIT_TRANSACTIONS')
              ->insert(['transaction_number' => $line[0],
               'transaction_date' => $transaction_date,
               'terminal_number' => $line[2],
               'value' => $line[3],
               'card_number' => $line[4],
               'source' => 1
               ]);

              $counter++;
            } catch (Exception $e) {
              Session::flash('add-transactions-fail', $e->getMessage());
            }
          }
           /**
            * SAVE IMPORT FILENAME
            */
           DB::table('SB_DEPOSIT_IMPORTS')
           ->insert(['filename' => $transaction_name,
            'created_by' => Auth::user()->id,
            'transaction_count' => $counter
            ]);
           /*
           * LOGGING THE IMPORT
           * 
            */
           $log = new \App\Log;
           $log->action_type = 3;
           $log->message = date('Y-m-d H:i:s') . " | Пользователь " . Auth::user()->username . " импортировал транзакции Сбербанка";
           $log->save();
          /**
           * 
           */
          $reader->close();
          Session::flash('add-transactions-ok', "Импорт данных прошел успешно, загружено " . $counter . " записей");
        } else Session::flash('add-transactions-fail', $content);
        return redirect()->back();
      }
      /**
       * [postImportTransactions description]
       * 
       */
      public function postImportNBDTransactions(Request $request){
        $transactions = $request->file('nbd-bank-transaction');
        $transaction_name = '/admin/files/transactions/NBD_BANK_TRANSACTION_'  . date('Ymd-His') . '.csv';
        if ($request->file('nbd-bank-transaction')->isValid()){
          Storage::disk('public')->put($transaction_name, File::get($transactions));
          $reader = CsvReader::open($transactions);
          $counter = 0;
          while (($line = $reader->readLine()) !== false) {
            try {
              $transaction_date = date_create_from_format('d.m.Y', $line[0]);
              if (strlen($line[2] = 5)) $line[2] = '0' . $line[2];
              if (strlen($line[2] = 4)) $line[2] = '00' . $line[2];
              if (strlen($line[2] = 3)) $line[2] = '000' . $line[2];
              DB::table('SB_DEPOSIT_TRANSACTIONS')
              ->insert(['transaction_number' => null,
               'transaction_date' => $transaction_date,
               'terminal_number' => null,
               'value' => $line[1],
               'card_number' => $line[2],
               'source' => 2
               ]);

              $counter++;
            } catch (Exception $e) {
              Session::flash('add-transactions-fail', $e->getMessage());
            }
          }
           /**
            * SAVE IMPORT FILENAME
            */
           DB::table('SB_DEPOSIT_IMPORTS')
           ->insert(['filename' => $transaction_name,
            'created_by' => Auth::user()->id,
            'transaction_count' => $counter
            ]);
           /*
           * LOGGING THE IMPORT
           * 
            */
           $log = new \App\Log;
           $log->action_type = 3;
           $log->message = date('Y-m-d H:i:s') . " | Пользователь " . Auth::user()->username . " импортировал транзакции пополнения";
           $log->save();
          /**
           * 
           */
          $reader->close();
          Session::flash('add-transactions-ok', "Импорт данных прошел успешно, загружено " . $counter . " записей");
        } else Session::flash('add-transactions-fail', $content);
        return redirect()->back();
      }
      /**
       * [postUpdateCards description]
       * @param  Request $request [description]
       * @return [type]           [description]
       */
      public function postUpdateCards(Request $request){
        $updated_cards = $request->file('update-cards');
        $updated_cards_name = '/admin/files/updates/UPDATED_CARDS_'  . date('Ymd-His') . '.csv';
        if ($request->file('update-cards')->isValid()){
          Storage::disk('public')->put($updated_cards_name, File::get($updated_cards));
          $reader = CsvReader::open($updated_cards);
          $counter = 0;
          while (($line = $reader->readLine()) !== false) {
            try {
              /**
               * MODIFY DATE
               * @var [type]
               */
              if ($line[13] == 0){
                $last_trip_date = null;
              } else $last_trip_date = date_create_from_format('d.m.Y H:i:s', $line[13]);
              /**
               * CHECK FOR PRIVILEGE ID
               */
              if ($line[5] == ''){
                $line[5] = null;
              }
              /**
               * CHECK FOR RIGHT FLOAT VALUE
               */
              if ($line[12] !== ""){
                if (!is_int($line[12])){
                  $ep_balance_fact = str_replace(',', '.', $line[12]);
                }
              } else {
                $ep_balance_fact = 0;
              }
              /**
               * 
               */
              if ($line[14] == ""){
                $travel_doc_kind = 0;
              } else {
                $travel_doc_kind = $line[14];
              }
              DB::table('ETK_CARDS')
              ->where('num',$line[2])
              ->update(['kind' => $line[0],
               'series' => $line[1],
               'num' => $line[2],
               'chip' => $line[3],
               'id_privilege' => $line[5],
               'id_privilege_group' => $line[6],
               'F' => $line[7],
               'I' => $line[8],
               'O' => $line[9],
               'type' => $line[10],
               'state' => $line[11],
               'ep_balance_fact' => $ep_balance_fact,
               'date_of_travel_doc_kind_last' => $last_trip_date,
               'travel_doc_kind' => $travel_doc_kind
               ]);
              $counter++;
            } catch (Exception $e) {
              Session::flash('update-cards-fail', $e->getMessage());
            }
          }
           /**
            * SAVE IMPORT FILENAME
            */
           DB::table('ETK_CARDS_UPDATES')
           ->insert(['filename' => $updated_cards_name,
            'created_by' => Auth::user()->id,
            'transaction_count' => $counter
            ]);
           /*
           * LOGGING THE IMPORT
           * 
            */
           $log = new \App\Log;
           $log->action_type = 7;
           $log->message = date('Y-m-d H:i:s') . " | Пользователь " . Auth::user()->username . " обновил список карт";
           $log->save();
          /**
           * 
           */
          $reader->close();
          Session::flash('update-cards-ok', "Обновление данных прошло успешно, обновлено " . $counter . " записей");
        } else Session::flash('update-cards-fail', 'С файлом что-то не так');
        return redirect()->back();
      }

 public function postImportTrips(Request $request){
        $new_trips = $request->file('new-trips');
        $new_trips_name = '/admin/files/imports/IMPORTED_TRIPS_'  . date('Ymd-His') . '.csv';
        if ($request->file('new-trips')->isValid()){
          Storage::disk('public')->put($new_trips_name, File::get($new_trips));
          $reader = CsvReader::open($new_trips);
          $counter = 0;
          while (($line = $reader->readLine()) !== false) {
            try {
              $trip_date = date_create_from_format('d.m.Y H:i:s', $line[1]);
              /**
               * CHECK FOR RIGHT FLOAT VALUE
               */
              if ($line[2] !== ""){
                if (!is_int($line[2])){
                  $ep_balance = str_replace(',', '.', $line[2]);
                }
              } else {
                $ep_balance = 0;
              }
              /**
               * 
               */
              if ($line[3] == ""){
                $amount = 0;
              } else {
                $amount = $line[3];
              }
              /**
               * 
               */
              if ($line[4] == ""){
                $ticket_num = null;
              } else {
                $ticket_num = $line[4];
              }
              /**
               * 
               */
              if ($line[5] == ""){
                $id_route = null;
              } else {
                $id_route = $line[5];
              }
              /**
               * 
               */
              
              DB::table('ETK_T_DATA')
              ->insert(['KIND' => $line[0],
               'DATE_OF' => $trip_date,
               'EP_BALANCE' => $ep_balance,
               'AMOUNT' => $amount,
               'TICKET_NUM' => $ticket_num,
               'ID_ROUTE' => $id_route,
               'CARD_SERIES' => $line[6],
               'CARD_NUM' => $line[7]
               ]);
              $counter++;
            } catch (Exception $e) {
              Session::flash('import-trips-fail', $e->getMessage());
            }
          }
           /**
            * SAVE IMPORT FILENAME
            */
           DB::table('ETK_T_DATA_IMPORTS')
           ->insert(['filename' => $new_trips_name,
            'created_by' => Auth::user()->id,
            'transaction_count' => $counter
            ]);
           /*
           * LOGGING THE IMPORT
           * 
            */
           $log = new \App\Log;
           $log->action_type = 8;
           $log->message = date('Y-m-d H:i:s') . " | Пользователь " . Auth::user()->username . " импортировал файл поездок";
           $log->save();
          /**
           * 
           */
          $reader->close();
          Session::flash('import-trips-ok', "Обновление данных прошло успешно, добавлено " . $counter . " записей");
        } else Session::flash('import-trips-fail', 'С файлом что-то не так');
        return redirect()->back();
      }


      /**
       * UPDATE CARDS BETA
       */
      public function postUpdateCardsBeta(Request $request){
        $updated_cards = $request->file('update-cards');
        if ($request->file('update-cards')->isValid()){
          $reader = CsvReader::open($updated_cards);
          $counter = 0;
          $sql = '';
          while (($line = $reader->readLine()) !== false) {
            try {
              /**
               * MODIFY DATE
               * @var [type]
               */
              $last_trip_date = date_create_from_format('d.m.Y H:i:s', $line[13]);
              /**
               * CHECK FOR PRIVILEGE ID
               */
              if ($line[5] == ''){
                $line[5] = null;
              }
              /**
               * CHECK FOR RIGHT FLOAT VALUE
               */
              if ($line[12] !== ""){
                if (!is_int($line[12])){
                  $ep_balance_fact = str_replace(',', '.', $line[12]);
                }
              } else {
                $ep_balance_fact = 0;
              }
              /**
               * 
               */
              if ($line[14] == ""){
                $travel_doc_kind = 0;
              } else {
                $travel_doc_kind = $line[14];
              }
              /**
               * 
               */
              if ($line[5] == ""){
                $id_privilege = 0;
              } else {
                $id_privilege = $line[5];
              }

              $sql .= 'UPDATE ETK_DB.ETK_CARDS SET ';
              $sql .= 'kind="' . $line[0] . '", ';
              $sql .= 'series="' . $line[1] . '", ';
              $sql .= 'num="' . $line[2] . '", ';
              $sql .= 'chip="' . $line[3] . '", ';
              $sql .= 'social_card="' . $line[4] . '", ';
              $sql .= 'id_privilege="' . $id_privilege . '", ';
              $sql .= 'id_privilege_group="' . $line[6] . '", ';
              $sql .= 'F="' . $line[7] . '", ';
              $sql .= 'I="' . $line[8] . '", ';
              $sql .= 'O="' . $line[9] . '", ';
              $sql .= 'type="' . $line[10] . '", ';
              $sql .= 'state="' . $line[11] . '", ';
              $sql .= 'ep_balance_fact="' . $ep_balance_fact . '", ';
              $sql .= 'date_of_travel_doc_kind_last=STR_TO_DATE("' . $line[13]. '","%d.%m.%Y %H:%i:%s"), ';
              $sql .= 'travel_doc_kind=' . $travel_doc_kind . ' ';
              $sql .= 'WHERE num=' . $line[2] . ';';
              $counter++;
            } catch (Exception $e) {
              Session::flash('update-cards-fail', $e->getMessage());
            }
          }
          /**
           * 
           */
          $reader->close();
          $updated_cards_name = '/admin/files/updates/UPDATED_CARDS_SQL'  . date('Ymd-His') . '.sql';
          Storage::disk('public')->put($updated_cards_name, $sql);
          Session::flash('update-cards-ok', "Обновление данных прошло успешно, обновлено " . $counter . " записей");
        } else Session::flash('update-cards-fail', 'С файлом что-то не так');
        return redirect()->back();
      }
      /**
       * ACCEPT DETALIZATION REQUEST
       * @param  Request $request [description]
       * @return [type]           [description]
       */
      public function postAcceptDetailingRequest(Request $request){
        $request_id  = $request['request_id'];
        $executed_by = $request['executed_by'];

        $accept = DB::table('ETK_DETAILING_REQUEST')
        ->where('id', $request_id)
        ->update([
          'executed_by' => $executed_by,
          'status' => 2
          ]);
        $log = new \App\Log;
        $log->action_type = 6;
        $log->message = date('Y-m-d H:i:s') . " | Пользователь " . Auth::user()->username . " принял к обработке запрос на детализацию №" . $request_id;
        $log->save();
        Session::flash('request_accepted', 'Запрос принят к обработке');
        return redirect()->back();              
      }
      /**
       * ATTACH FILE AND SEND EMAIL
       * @param  Request $request [description]
       * @return [type]           [description]
       */
      public function postAttachFileForDetailingRequest(Request $request){
        $request_id  = $request['request_id'];
        $user_id     = $request['user_id'];
        $user = \App\User::find($request['user_id']);
        $email = $user->email;
        $report = $request->file('report');
        $file_extension = $request->file('report')->getClientOriginalExtension();
        $reportname = '/docs/reports/detalization/' . date('Ymd-His') . '_' . $request_id . '.' . $file_extension;
        if ($report){
          Storage::disk('public')->put($reportname, File::get($report));
          if ($report_query = DB::table('ETK_DETAILING_REQUEST')
            ->where('id', $request_id)
            ->update([
              'filepath' => $reportname,
              'status' => 3
              ])){
            Mail::send('emails.send_report_notification',
             [],
             function ($m) use ($email){
               $m->from('no-reply@etk21.ru', 'Служба поддержки ЕТК');
               $m->to($email)->subject('Ваш отчет готов!');
             });
         Session::flash('add-report-ok', 'Отчет добавлен');
       }
     } else Session::flash('add-report-error', 'Произошла ошибка');
     return redirect()->back();
   }


   public function postBlockCard(Request $request){
    $card_number = $request['card_number'];
    $card_serie = $request['card_serie'];
    $to_state = $request['to_state'];
    $user_id = Session::get('user_id');
    /**
     * [$prefix description]
     * @var string
     */
    if ($card_serie !== 99){ $prefix = '01'; } else {$prefix = '02';}
    /**
     * [$fullcard_number description]
     * @var [type]
     */
    $fullcard_number = $prefix . $card_serie . $card_number;
    $card = DB::table('ETK_CARDS')
              ->where('num', $fullcard_number)
              ->first();
    $chip = $card->chip;
    if (DB::table('ETK_BLOCKLISTS')
          ->where('card_number', $fullcard_number)
          ->where('is_loaded', 0)
          ->first()){
      Session::flash('number-already-isset','Данная карта уже стоит в очереди на блокировку');
      return redirect()->back();      

    }
    if (DB::table('ETK_BLOCKLISTS')
          ->insert(['card_number' => $fullcard_number,
                    'chip' => $chip,
                    'operation_type' => $to_state,
                    'source' => 1,
                    'created_by' => $user_id
                    ])){
      Session::flash('add-to-blocklist-success','Карта ' . $fullcard_number . ' успешно добавлена в блок-лист');
      return redirect()->back();
    } else {
      Session::flash('add-to-blocklist-fail','Не удалось добавиь карту в блок-лист');
      return redirect()->back();
    }
   }
   /**
    * [postMakeStatuscard description]
    * @param  Request $request [description]
    * @return [type]           [description]
    */
   public function postMakeStatuscard(Request $request){
    $source = $request['source'];
    $filename = '/admin/files/statuscard/statuscard-21-' . date('ymd') . '-0000' . $source . '.txt';
    $path = public_path() . '/admin/files/statuscard/statuscard-21-' . date('ymd') . '-0000' . $source . '.txt';
    $fp = fopen($path, 'w');

    $status_count = 0;
    $cards = DB::table('ETK_BLOCKLISTS')
                ->where('source', $source)
                ->where('is_loaded', 0)
                ->get();
    foreach ($cards as $card) {
      $status_count++;
      $row = $card->chip . "\t" . $card->operation_type . "\r\n";
      fwrite($fp, $row);
    }
    fclose($fp);
    if (DB::table('ETK_STATUSCARDS')
          ->insert(['filename' => $filename,
                    'status_count' => $status_count,
                    'created_by' => Auth::user()->id])){
      DB::table('ETK_BLOCKLISTS')
        ->where('source', $source)
        ->where('is_loaded', 0)
        ->update(['is_loaded' => 1]);
      Session::flash('file-creation-success','Файл составлен');
      return redirect()->back();
    } else {
       Session::flash('file-creation-fail','Создать файл не удалось');
       return redirect()->back();     
    }

   }

   public function getCancelBlockCard($card_number){
    $user_id = Auth::user()->id;
    if ($card = DB::table('ETK_BLOCKLISTS')
          ->where('card_number',$card_number)
          ->first()){
      if ($card->created_by == $user_id){
        DB::table('ETK_BLOCKLISTS')
          ->where('card_number', $card_number)
          ->delete();
        Session::flash('cancel-block-success', 'Карта ' . $card_number . ' успешно удалена из блок-листа');  
        return redirect()->back();  
      } else {
        Session::flash('cancel-block-access-denied', 'Вы не можете отменить действие другого пользователя');
        return redirect()->back();
      }
    }
   }
   /**
    * [ajaxCheckCardOperations description]
    * @param  Request $request [description]
    * @return [type]           [description]
    */
   public function ajaxCheckCardOperations(Request $request){
    $num   = $request['num'];
    $serie = $request['serie'];
    $operations = DB::table('SB_DEPOSIT_TRANSACTIONS')
    ->where('card_number',  $num)
    ->orderBy('transaction_date', 'DESC')
    ->get();
    foreach ($operations as $operation) {
      $format_date = new \DateTime($operation->transaction_date);
      $operation->transaction_date = $format_date->format('d.m.Y');
    }
  if ($serie !== null){
     if ($serie == '99'){
      $semifullnumber = '02' . $serie . $num;
     } else {
      $semifullnumber = '01' . $serie . $num;
    }
  } else $semifullnumber = '0123' . $num;
    if (($card = DB::table('ETK_CARDS')
                 ->where('num', $semifullnumber)
                 ->first()) == NULL){
    $card_digit_state = 0;
    $cur_balance = "Карта не найдена";
    $cur_state = 'Состояние не определено';
    $cur_last_operation = null;
    } else {
      $card_digit_state = $card->state;
      $cur_balance = $card->ep_balance_fact;
      switch ($card->state) {
        case 1:
          $cur_state = 'В обращении';
          break;
        case 2:
          $cur_state = 'В блокировочном списке';
          break;
        case 3:
          $cur_state = 'Заблокирована';
          break;
        case 4:
          $cur_state = 'В деблокировочном списке';
          break;
        case 5:
          $cur_state = 'Изъята';
          break; 
        default:
          $cur_state = 'Не определено';
          break;
      }
      $cur_last_operation = $card->date_of_travel_doc_kind_last;
    }
    /**
     * GET TRIPS
     * @var [type]
     */
      if ($semifullnumber){
        if ($trips = DB::table('ETK_T_DATA')
                    ->where('CARD_NUM', $semifullnumber)
                    ->orderBy('DATE_OF', 'DESC')
                    ->limit(10)
                    ->get()){
          foreach ($trips as $trip){
            $trip->DATE_OF = new \Datetime($trip->DATE_OF);
            $trip->DATE_OF = date_format($trip->DATE_OF,'d.m.Y H:i:s');
            if ($trip->ID_ROUTE == NULL) $trip->ID_ROUTE = 'Пополнение';
          }
        } else $trips = null;
      } else $trips = null;

    if ($operations == NULL)
      return response()->json(['message' => 'error'],200);
    if ($operations !== NULL)
      return response()->json(['message' => 'success', 'data' => $operations, 'balance' => $cur_balance, 'state' => $cur_state, 'card_state'=> $card_digit_state,'last_operation' => $cur_last_operation, 'trips' => $trips],200);

  }
}
