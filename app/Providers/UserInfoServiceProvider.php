<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class UserInfoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('user', function () {
            return new \stdClass(); // Placeholder for the data
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
