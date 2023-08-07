<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Starmoozie\LaravelMenuPermission\app\Models\Route;

class RouteSeeder extends Seeder
{
    protected $data = [
        [
            // 'name'         => 'route', // Name of route menu
            // 'method'       => 'crud', // crud, get, post, put, patch, delete
            // 'controller'   => 'NameCrudController', // Name of controller
            // 'type'         => 'dashboard' // dashboard, api, dahsboard_api, web
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->data as $route) {
            Route::updateOrCreate($route, $route);
        }
    }
}
