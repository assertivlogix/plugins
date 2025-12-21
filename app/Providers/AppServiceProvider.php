<?php

namespace App\Providers;

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
        // Share active plugins with all views for the header menu
        if (!\App::runningInConsole()) {
            $menuPlugins = \App\Models\Product::where('is_active', true)->get();
            \Illuminate\Support\Facades\View::share('menuPlugins', $menuPlugins);
        }
    }
}
