<?php

namespace Ishannz\LaravelEvernote;

use Illuminate\Support\ServiceProvider;
use App;

class LaravelEvernoteServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        require_once __DIR__ . '/evernote/autoload.php';
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('evernote', function()
        {
            return new \Ishannz\LaravelEvernote\Evernote;
        });
    }
}
