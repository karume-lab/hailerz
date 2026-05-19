<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\URL;
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
            $view->with('allCategories', Category::where('is_active', true)->orderBy('name')->get());
        });

        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
