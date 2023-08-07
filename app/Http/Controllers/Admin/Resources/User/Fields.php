<?php

namespace App\Http\Controllers\Admin\Resources\User;

trait Fields
{
    /**
     * Define create / update form fields.
     * 
     * @return void
     */
    protected function setFields()
    {
        $this->crud->field('name')
        ->label(__('starmoozie::base.name'))
        ->size(4);

        $this->crud->field('email')
        ->size(4)
        ->label(__('starmoozie::menu_permission.email'));

        $this->crud->field('mobile')
        ->size(4)
        ->label(__('starmoozie::menu_permission.mobile'));

        $this->crud->field('role')
        ->size(6)
        ->allows_null(false)
        ->label(__('starmoozie::menu_permission.role'))
        ->options(fn($q) => $q->when(!is_me(starmoozie_user()->email), fn($q) => $q->where('name', '!=', 'developer')));

        $this->crud->field('groups')
        ->size(6)
        ->ajax(true)
        ->multiple(true)
        ->pivot(true)
        ->minimum_input_length(0)
        ->allows_null(false)
        ->label(__('starmoozie::title.group'))
        ->ajax(true)
        ->inline_create(['entity' => 'group']);

        $this->crud->field('password')
        ->type('password')
        ->size(6)
        ->label(__('starmoozie::menu_permission.password'));

        $this->crud->field('password_confirmation')
        ->type('password')
        ->size(6)
        ->label(__('starmoozie::menu_permission.password_confirm'));
    }
}
