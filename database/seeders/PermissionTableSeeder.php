<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $permissions = [

            // admin panel permissions

            [
                'name' => 'dashboard.index',
            ],

            // user permissions

            [
                'name' => 'users.index',
            ],

            [
                'name' => 'users.edit',
            ],

            [
                'name' => 'users.delete',
            ],

            [
                'name' => 'users.create',
            ],

            [
                'name' => 'users.show',
            ],


            // role permissions

            [
                'name' => 'roles.index',
            ],

            [
                'name' => 'roles.edit',
            ],

            [
                'name' => 'roles.delete',
            ],

            [
                'name' => 'roles.create',
            ],

            [
                'name' => 'roles.show',
            ],

            //home.index
            [
                'name' => 'home.index'
            ],


            // permission permissions

            [
                'name' => 'permissions.index',
            ],

            [
                'name' => 'permissions.edit',
            ],

            [
                'name' => 'permissions.delete',
            ],

            [
                'name' => 'permissions.create',
            ],

            //layout.empty.index
            [
                'name' => 'layout.empty.index',
            ],

            //layout.bank
            [
                'name' => 'bank.index',
            ],
            [
                'name' => 'bank.edit',
            ],
            [
                'name' => 'bank.show',
            ],
            [
                'name' => 'bank.delete',
            ],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}