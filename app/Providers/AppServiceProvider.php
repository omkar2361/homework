<?php

namespace App\Providers;

use App\Observers\SaleTransactionObserver;
use App\SaleTransaction;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        SaleTransaction::observe(SaleTransactionObserver::class);
    }
}
