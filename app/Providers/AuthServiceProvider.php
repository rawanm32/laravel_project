<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //$this->registerPolicies();
        //         // لارافيل رح تمرر اليوزر او الادمن وحسب مين يلي عامل لوغين
        // Gate::define('categories.view', function ($user) {
        //          return true;
        // });
        // Gate::define('categories.create', function ($user) {
        //          return false;

        // });
        // Gate::define('categories.update', function ($user) {
        //          return true;

        // });
        // Gate::define('categories.delete', function ($user) {
        //          return false;

        // });
        // 
        
         Gate::before(function ($user, $ability) {
            if ($user->super_admin) { // true, false // 1=> true
                return true;
            }
        });
        foreach(config('abilities') as $code => $lable) // code is key
        {
            Gate::define($code, function ($user) use ($code) {
                return $user->hasAbility($code);
     
            });
        }
    }
}
