<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class SiteController extends Controller
{
    public function getIndexPage(){
    	$articles = DB::table('articles')
    					->orderBy('created_at', 'desc')
    					->take(3)
    					->get();
    	Carbon::setLocale('ru');
    	foreach ($articles as $article) {
    		$non_formatted_date = new Carbon($article->created_at);
    		$date = $non_formatted_date->diffForHumans();
    		$article->created_at = $date;
    	}
    	return view('index',[
    		'articles' => $articles
    		]);
    }
    public function getAboutPage(){
    	return view('pages.about');
    }
    public function getNewsPage(){
    	$articles = DB::table('articles')
                        ->where('published', '=', 1)
    					->orderBy('created_at', 'desc')
    					->paginate(9);
    	Carbon::setLocale('ru');
    	/**
    	 * Make a human-readable date
    	 */
    	foreach ($articles as $article) {
    		$non_formatted_date = new Carbon($article->created_at);
    		$date = $non_formatted_date->format('j/m/Y');
    		$article->created_at = $date;
    	}
    	/**
    	 * 
    	 */
    	return view('pages.news',[
    		'articles' => $articles
    		]);
    }
    public function getArticle($id){
    	$article = DB::table('articles')
    					->where('id', $id)
                        ->where('published', '1')
    					->first();
    	Carbon::setLocale('ru');
    	$non_formatted_date = new Carbon($article->created_at);
    	$date = $non_formatted_date->format('j/m/Y');
    	$article->created_at = $date;
    	return view('pages.article',[
    		'article' => $article
    		]);
    }
}
