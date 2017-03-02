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
}
