<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Utils\Token;
class TokenServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind('token',function(){
            return new Token();
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
