<?php

namespace App\Providers;

use App\Interfaces\FavouriteBookInterface;
use App\Services\FavouriteBookService;
use Illuminate\Support\ServiceProvider;

class FavouriteBookServiceProvider extends ServiceProvider
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
        $this->app->bind(FavouriteBookInterface::class, FavouriteBookService::class);
    }
}
