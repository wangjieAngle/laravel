<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Service\Testtwo;

class TestServiceProvider extends ServiceProvider
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
        //
        $this->app->singleton('testtwo', function () {
            return new Testtwo();
//            return new BigData(config('config.big_data_domain'), config('config.big_data_app_code'), config('config.big_data_org_code'));
        });
    }

}
