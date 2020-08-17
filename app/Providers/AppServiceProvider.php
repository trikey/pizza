<?php

namespace App\Providers;

use App\Category;
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
        view()->share('categories', cache()->remember('categories', 120, function () {
            return Category::all();
        }));

        app()->bind('cart-helper', \App\Lib\Sale\CartHelper::class);
    }
}
