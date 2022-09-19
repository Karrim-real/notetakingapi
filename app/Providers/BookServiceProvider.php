<?php

namespace App\Providers;

use App\Interfaces\BookInterface;
use App\Services\BookService;
use Illuminate\Support\ServiceProvider;

class BookServiceProvider extends ServiceProvider
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
        $this->app->bind(BookInterface::class, BookService::class);
    }
}
