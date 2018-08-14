<?php

namespace Jorjika\Bookings;

use Illuminate\Support\ServiceProvider;

class BookingsServiceProvider extends ServiceProvider{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }

    public function register()
    {

    }
}
