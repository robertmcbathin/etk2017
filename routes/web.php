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
    Route::get('/static_articles', [
        'uses' => 'SiteController@getStaticArticlesPage',
        'as' => 'static_articles'
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
    Route::get('/deposit-points-list', [
        'uses' => 'SiteController@getDepositPointsListPage',
        'as' => 'deposit-points-list'
        ]);
    Route::get('/sell-points-list', [
        'uses' => 'SiteController@getSellPointsListPage',
        'as' => 'sell-points-list'
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
    Route::get('/balance', [
        'uses' => 'PaymentController@getBalancePage',
        'as' => 'balance'
        ]);
        /**
         * STATIC ARTICLES
         */
    Route::get('/static_articles/is-it-safely', function(){
        return view('pages.static_articles.is-it-safely');
    });
        /**
         * 
         */
});
Route::group(['prefix' => 'sudo'], function () {
    Route::get('login', function ()    {
        return view('sudo.login');
    })->name('sudo.login');
    Route::post('login', [
        'uses' => 'UserController@postLogin',
        'as' => 'sudo.login.post' 
        ]);
});
Route::group(['middleware' => 'auth'], function()
{
Route::group(['prefix' => 'sudo'], function () {
    Route::get('dashboard', [
        'uses' => 'SudoController@getDashboard',
        'as' => 'sudo.pages.dashboard'
        ]);
    Route::get('articles', [
        'uses' => 'SudoController@getArticlesPage',
        'as' => 'sudo.pages.articles'
        ]);
    Route::get('logout', [
        'uses' => 'UserController@postLogout',
        'as' => 'sudo.logout.post' 
        ]);
    Route::get('/articles/add',[
        'uses' => 'SudoController@getAddArticle',
        'as' => 'sudo.articles.add.get'
        ]);
    Route::post('/articles/add',[
        'uses' => 'SudoController@postAddArticle',
        'as' => 'sudo.articles.add.post'
        ]);

    Route::get('/articles/edit/{id}',[
        'uses' => 'SudoController@getEditArticle',
        'as' => 'sudo.articles.edit.get'
        ]);
    Route::post('/articles/edit',[
        'uses' => 'SudoController@postEditArticle',
        'as' => 'sudo.articles.edit.post'
        ]);
    Route::post('/articles/delete/{id}',[
        'uses' => 'SudoController@postDeleteArticle',
        'as' => 'sudo.articles.delete'
        ]);
    /**
     * QUESTIONS    
     */
    Route::get('questions', [
        'uses' => 'SudoController@getQuestionsPage',
        'as' => 'sudo.pages.questions'
        ]);
    /**
     * 
     */
});
});

