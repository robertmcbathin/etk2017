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
    Route::get('/sell-points', [
        'uses' => 'SiteController@getSellPointsPage',
        'as' => 'sell-points'
        ]);
    Route::get('/how-to-refill', [
        'uses' => 'SiteController@getHowToRefillPage',
        'as' => 'how-to-refill'
        ]);
    Route::get('/how-to-refill-sberbank', [
        'uses' => 'SiteController@getHowToRefillSberbankPage',
        'as' => 'how-to-refill-sberbank'
        ]);
     Route::get('/faq', [
        'uses' => 'SiteController@getFaqPage',
        'as' => 'faq'
        ]);
    Route::get('/contacts', [
        'uses' => 'SiteController@getContactsPage',
        'as' => 'contacts'
        ]);
    Route::get('/ask', [
        'uses' => 'SiteController@getAskPage',
        'as' => 'ask'
        ]);
    Route::post('/ask', [
        'uses' => 'SiteController@postQuestion',
        'as' => 'ask.add.post'
        ]);
    Route::get('/law', [
        'uses' => 'SiteController@getLawPage',
        'as' => 'law'
        ]);
    Route::get('/contacts', [
        'uses' => 'SiteController@getContactsPage',
        'as' => 'contacts'
        ]);
    /**
     * CARDS
     */
    Route::get('/cards', [
        'uses' => 'SiteController@getCardsPage',
        'as' => 'cards'
        ]);
    Route::get('/cards/e-wallet', [
        'uses' => 'SiteController@getEwalletPage',
        'as' => 'cards.ewallet'
        ]);
    Route::get('/cards/travel-cards', [
        'uses' => 'SiteController@getTravelCardsPage',
        'as' => 'cards.travel_cards'
        ]);
    Route::get('/cards/sbercard', [
        'uses' => 'SiteController@getSbercardPage',
        'as' => 'cards.sbercard'
        ]);
    Route::get('/cards/{id}', [
        'uses' => 'SiteController@getCard',
        'as' => 'card'
        ]);
    Route::get('/faq', [
        'uses' => 'SiteController@getFaqPage',
        'as' => 'faq'
        ]);
    Route::get('/contacts', [
        'uses' => 'SiteController@getContactsPage',
        'as' => 'contacts'
        ]);
    Route::get('/ask', [
        'uses' => 'SiteController@getAskPage',
        'as' => 'ask'
        ]);
    Route::post('/ask', [
        'uses' => 'SiteController@postQuestion',
        'as' => 'ask.add.post'
        ]);
});

