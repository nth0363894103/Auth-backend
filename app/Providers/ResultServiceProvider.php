<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Utils\Result;
class ResultServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind('result',function(){
            return new Result();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
