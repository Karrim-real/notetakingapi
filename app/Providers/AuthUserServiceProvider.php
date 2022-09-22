<?php

namespace App\Providers;

use App\Interfaces\AuthUserInterface;
use App\Services\AuthUserService;
use Illuminate\Support\ServiceProvider;

class AuthUserServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(AuthUserInterface::class, AuthUserService::class);
    }
}
