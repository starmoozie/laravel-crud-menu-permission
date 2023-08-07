<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Starmoozie\LaravelMenuPermission\app\Models\Menu;
use Starmoozie\LaravelMenuPermission\app\Models\Permission;

class MenuSeeder extends Seeder
{
    protected $data = [
        [
            'name'        => 'group',
            'route'       => 'group',
            'permissions' => ['create', 'read', 'update', 'delete']
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->data as $value) {
            $data = \Arr::only($value, ['name', 'route']);
            $menu = Menu::updateOrCreate($data, $data);

            // Insert permissions
            $permissions = Permission::whereIn('name', $value['permissions'])->pluck('id')->toArray();
            $menu->permission()->sync($permissions);
        }
    }
}
