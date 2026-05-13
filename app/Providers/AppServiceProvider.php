<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::addNamespace('layouts', resource_path('views/components/layouts'));

        // Share active categories with all views
        View::composer('*', function ($view) {
            $view->with('allCategories', \App\Models\Category::where('is_active', true)->orderBy('name')->get());
        });

        if ($this->app->environment('production')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }
    }
}
