<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware' => 'web'], function () {
    Route::get('/', [
	    'uses' => 'SiteController@getIndexPage',
	    'as' => 'index'
	]);
	Route::get('/about',[
		'uses' => 'SiteController@getAboutPage',
	    'as' => 'about'
		]);
	Route::get('/news', [
        'uses' => 'SiteController@getNewsPage',
        'as' => 'news'
        ]);
    Route::get('/news/{id}', [
        'uses' => 'SiteController@getArticle',
        'as' => 'article'
        ]);
    Route::get('/deposit-points', [
        'uses' => 'SiteController@getDepositPointsPage',
        'as' => 'deposit-points'
        ]);
});

