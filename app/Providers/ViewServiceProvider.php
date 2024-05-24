<?php

namespace App\Providers;

use Illuminate\View\View;
use Illuminate\Support\Facades;
use Illuminate\Support\ServiceProvider;
use App\View\Composers\LowlevelComposer;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // ...
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Using class based composers...
        Facades\View::composer('layouts.tabler', LowlevelComposer::class);

        Facades\View::composer('dashboard', LowlevelComposer::class);



    }
}
