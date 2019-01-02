<?php

namespace Untrefmedia\UMBooks;

use Illuminate\Support\ServiceProvider;

class UMBooksProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/um-books.php' => config_path('um-books.php')
        ], 'config');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        require __DIR__ . '/routes/web.php';
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'umbooks');
    }
}
