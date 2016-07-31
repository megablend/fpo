<?php

namespace App\Providers;
use App\Classes\MerchantsHelper;
use Illuminate\Support\ServiceProvider;

class MerchantsHelperServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Merchants', function ($app) {
            return new MerchantsHelper();
        });
    }
}
