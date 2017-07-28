<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use DB;
use View;
use URL;
use Session;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (env('APP_ENV') === 'production') {
            URL::forceSchema('https');
        }
        $new_detailing_requests_count = DB::table('ETK_DETAILING_REQUEST')
                                    ->where('status', 1)
                                    ->count();
        $new_detailing_requests = DB::table('ETK_DETAILING_REQUEST')
                                    ->where('status', 1)
                                    ->get();
        $blocklist_count = DB::table('ETK_BLOCKLISTS')
                                    ->where('is_loaded', 0)
                                    ->count();
        $blocklist = DB::table('ETK_BLOCKLISTS')
                                    ->join('users','ETK_BLOCKLISTS.created_by', '=', 'users.id')
                                    ->select('ETK_BLOCKLISTS.card_number','users.id', '=', 'ETK_BLOCKLISTS.created_by')
                                    ->where('ETK_BLOCKLISTS.is_loaded', 0)
                                    ->select('ETK_BLOCKLISTS.card_number','users.name')
                                    ->get();

        View::share('new_detailing_requests_count', $new_detailing_requests_count);
        View::share('new_detailing_requests', $new_detailing_requests);
        View::share('blocklist_count', $blocklist_count);
        View::share('blocklist', $blocklist);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (env('APP_ENV') === 'production') {
        $this->app['request']->server->set('HTTPS', true);
}
    }
}
