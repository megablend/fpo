<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Helper;
use App\Customer;
class CommonAppDataServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->share('school_name', 'Federal Polytechnic Oko');
        view()->share('company_telephone', '08060108165');
        view()->share('company_address', '234 Maitama Sule, Maidugiri');
        view()->share('company_city', 'Yawoose');
        view()->share('company_state', 'Kaduna');
        view()->share('company_name', 'Federal  Polytechnic Oko, Anambra State.');
        // view()->share('app_default_navigation', $app_default_navigation);
        // view()->share('social_media', $social_media);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
