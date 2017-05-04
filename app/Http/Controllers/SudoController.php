<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Session;
use CsvReader;
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
    	return view('sudo.pages.dashboard',[
    		'questions_count' => $questions_count,
        'waiting_for_activation' => $waiting_for_activation,
        'users_count' => $users_count
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
    public function togglePublishedChackbox(Request $request){
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
      return view('sudo.pages.import', [
        'last_import' => $last_import
       ]);
    }
    public function postImportTransactions(Request $request){
        $transactions = $request->file('sb-transaction');
        $transaction_name = '/admin/files/transactions/SB_TRANSACTION_'  . date('Ymd-His') . '.csv';
        $content = "";
        if ($request->file('sb-transaction')->isValid()){
            Storage::disk('public')->put($transaction_name, File::get($transactions));
            $reader = CsvReader::open($transactions);
            $counter = 0;
            while (($line = $reader->readLine()) !== false) {
              try {
                $transaction_date = date_create_from_format('d.m.Y', $line[1]);
                DB::table('SB_DEPOSIT_TRANSACTIONS')
                    ->insert(['transaction_number' => $line[0],
                             'transaction_date' => $transaction_date,
                             'terminal_number' => $line[2],
                             'value' => $line[3],
                             'card_number' => $line[4]
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
                        'created_by' => Auth::user()->id
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

    public function ajaxCheckCardOperations(Request $request){
      $num   = $request['num'];
      $operations = DB::table('SB_DEPOSIT_TRANSACTIONS')
                ->where('card_number', 'like',  $num)
                ->orderBy('transaction_date', 'DESC')
                ->get();
      foreach ($operations as $operation) {
        $format_date = new \DateTime($operation->transaction_date);
        $operation->transaction_date = $format_date->format('d.m.Y');
      }
      if ($operations == NULL)
        return response()->json(['message' => 'error'],200);
      if ($operations !== NULL)
        return response()->json(['message' => 'success', 'data' => $operations],200);

    }
}
