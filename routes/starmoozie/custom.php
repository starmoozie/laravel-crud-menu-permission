<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Starmoozie Routes
// --------------------------
// This route file is loaded automatically by Starmoozie\Base.
// Routes you generate using Starmoozie\Generators will be placed here.

Route::group([
    'prefix'     => config('starmoozie.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('starmoozie.base.web_middleware', 'web'),
        (array) config('starmoozie.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes

    // if configured, setup the dashboard routes
    if (!config('starmoozie.base.setup_dashboard_routes')) {
        Route::get('dashboard', 'DashboardController@dashboard')->name('starmoozie.dashboard');
        Route::get('/', 'DashboardController@redirect')->name('starmoozie');
    }

    if (!config('starmoozie.base.setup_user_url')) {
        Route::crud('user', 'UserCrudController');
    }

    if (\Illuminate\Support\Facades\Schema::hasTable('menu') && class_exists(\Starmoozie\LaravelMenuPermission\app\Models\Menu::class)) {
        foreach (\Starmoozie\LaravelMenuPermission\app\Models\Menu::whereNotNull('controller')->get() as $route) {
            Route::crud($route->route, $route->controller);
        }
    }

    if (\Illuminate\Support\Facades\Schema::hasTable('route') && class_exists(\Starmoozie\LaravelMenuPermission\app\Models\Route::class)) {
        foreach (\Starmoozie\LaravelMenuPermission\app\Models\Route::dashboard()->get() as $route) {
            Route::{$route->method}($route->route, $route->controller);
        }
    }
}); // this should be the absolute last line of this file