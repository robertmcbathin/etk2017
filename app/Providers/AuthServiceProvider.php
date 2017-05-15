<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('show-sudo', function($user){
            return $user->role_id <= 10;
        });
        Gate::define('show-import', function($user){
            return $user->role_id <= 2;
        });
        Gate::define('show-reports', function($user){
            return $user->role_id <= 2;
        });
        Gate::define('show-pages', function($user){
            return $user->role_id < 2;
        });

    }
    public function before($user, $ability)
        {
            if ($user->isSuperAdmin()) {
                return true;
            }
        }
}
