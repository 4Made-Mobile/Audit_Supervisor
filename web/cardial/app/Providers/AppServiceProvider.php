<?php

namespace cardial\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function boot()
    {
        \Blade::setEchoFormat('e(utf8_encode(%s))');
    }

    public function register()
    {
        
    }
}
