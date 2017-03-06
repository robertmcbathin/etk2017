<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Session;
use \App\Article;
use \App\Question;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SudoController extends Controller
{
    public function getDashboard(){
    	$questions = new Question;
    	$questions_count = $questions->count();
    	return view('sudo.pages.dashboard',[
    		'questions_count' => $questions_count
    		]);
    }
    public function getArticlesPage(){
    	$articles = DB::table('articles')
                      ->join('users','users.id','=','articles.user')
                      ->select('articles.*','users.name as author')
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
        $article = DB::table('articles')
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
        $questions = DB::table('questions')
                      ->orderBy('created_at','desc')  
                      ->paginate(10);   
        return view('sudo.pages.questions',[
            'questions' => $questions
            ]);
    }
}
