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
    /**
     * PROFILER ROUTES
     */
    Route::get('/profile', [
        'uses' => 'UserController@showProfile',
        'as' => 'profile'
        ]);
    Route::post('/profile/change_name',[
        'uses' => 'UserController@postChangeName',
        'as' => 'profile.change_name.post'
        ]);
    Route::post('/profile/change_password',[
        'uses' => 'UserController@postChangePassword',
        'as' => 'profile.change_password.post'
        ]);
    Route::post('/profile/delete_account',[
        'uses' => 'UserController@postDeleteAccount',
        'as' => 'profile.delete_account.post'
        ]);
    Route::post('/profile/request_details',[
        'uses' => 'UserController@postRequestDetails',
        'as' => 'profile.request_details.post'
        ]);
    /**
     * END OF PROFILE ROUTES
     */
    Route::group(['prefix' => 'sudo'], function () {
        Route::get('dashboard', [
            'uses' => 'SudoController@getDashboard',
            'as' => 'sudo.pages.dashboard'
            ])->middleware('can:show-sudo,App\User');
        Route::get('articles', [
            'uses' => 'SudoController@getArticlesPage',
            'as' => 'sudo.pages.articles'
            ])->middleware('can:show-sudo,App\User');
        Route::get('logout', [
            'uses' => 'UserController@postLogout',
            'as' => 'sudo.logout.post' 
            ])->middleware('can:show-sudo,App\User');
        Route::get('/articles/add',[
            'uses' => 'SudoController@getAddArticle',
            'as' => 'sudo.articles.add.get'
            ])->middleware('can:show-sudo,App\User');
        Route::post('/articles/add',[
            'uses' => 'SudoController@postAddArticle',
            'as' => 'sudo.articles.add.post'
            ])->middleware('can:show-sudo,App\User');

        Route::get('/articles/edit/{id}',[
            'uses' => 'SudoController@getEditArticle',
            'as' => 'sudo.articles.edit.get'
            ])->middleware('can:show-sudo,App\User');
        Route::post('/articles/edit',[
            'uses' => 'SudoController@postEditArticle',
            'as' => 'sudo.articles.edit.post'
            ])->middleware('can:show-sudo,App\User');
        Route::post('/articles/delete/{id}',[
            'uses' => 'SudoController@postDeleteArticle',
            'as' => 'sudo.articles.delete'
            ])->middleware('can:show-sudo,App\User');

        Route::get('/operations',[
            'uses' => 'SudoController@getOperationsPage',
            'as' => 'sudo.pages.operations'
            ])->middleware('can:show-sudo,App\User');
        Route::get('/detailing-requests',[
            'uses' => 'SudoController@getDetailingRequestsPage',
            'as' => 'sudo.pages.detailing-requests'
            ])->middleware('can:show-sudo,App\User');
        Route::get('/import',[
            'uses' => 'SudoController@getImportPage',
            'as' => 'sudo.pages.import'
            ])->middleware('can:show-sudo,App\User');
        Route::post('/import/transactions',[
            'uses' => 'SudoController@postImportTransactions',
            'as' => 'sudo.import.transactions.post'
            ])->middleware('can:show-sudo,App\User');
    /**
     * QUESTIONS    
     */
    Route::get('questions', [
        'uses' => 'SudoController@getQuestionsPage',
        'as' => 'sudo.pages.questions'
        ])->middleware('can:show-sudo,App\User');
    /**
     * 
     */
    Route::post('/sudo/ajax/check_card_operations', [ 'uses' =>
        'SudoController@ajaxCheckCardOperations',
        'as' => 'ajax.check_card_operations'
        ])->middleware('can:show-sudo,App\User');
});
});


Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/home', 'UserController@getHomePage');
Route::get('/confirm-account/{register_token}',[
    'uses' => 'Auth\RegisterController@confirmAccount',
    'as' => 'confirm-account'
    ]);
Route::post('/password/send_new_password',[
    'uses' => 'UserController@sendNewPassword',
    'as' => 'password.send-new-password'
    ]);
Route::get('/confirm-new-password/{confirmation_token}/{password}',[
    'uses' => 'UserController@confirmNewPassword',
    'as' => 'confirm-new-password'
    ]);
/**
 * AJAX ROUTES
 */
Route::post('/ajax/check_card_on_exist', [ 'uses' =>
    'UserController@ajaxCheckCardOnExist',
    'as' => 'ajax.check_card_on_exist'
    ]);
Route::post('/ajax/check_email_on_exist', [ 'uses' =>
    'UserController@ajaxCheckEmailExist',
    'as' => 'ajax.check_email_on_exist'
    ]);
/**
 * 
 */