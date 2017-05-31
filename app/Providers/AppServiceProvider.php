<?php

namespace App\Providers;

use Auth;
use DB;
use View;
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
        $new_detailing_requests_count = DB::table('ETK_DETAILING_REQUEST')
                                    ->where('status', 1)
                                    ->count();
        $new_detailing_requests = DB::table('ETK_DETAILING_REQUEST')
                                    ->where('status', 1)
                                    ->get();

        View::share('new_detailing_requests_count', $new_detailing_requests_count);
        View::share('new_detailing_requests', $new_detailing_requests);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
