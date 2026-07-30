<?php

namespace App\Providers;

use App\Models\MenuItem;
use Illuminate\Pagination\Paginator;
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
        if ($root = config('app.url')) {
            URL::forceRootUrl(rtrim($root, '/'));
        }

        Paginator::useBootstrapFive();
        Paginator::defaultView('vendor.pagination.bootstrap-5');

        View::composer('front.partials.header', function ($view) {
            $view->with([
                'primaryMenu' => MenuItem::treeForLocation('primary'),
                'secondaryMenu' => MenuItem::treeForLocation('secondary'),
            ]);
        });
    }
}
