<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'title' => 'Superadmin',
            'short_code' => 'Superadmin',
        ]);

        Role::create([
            'title' => 'User',
            'short_code' => 'User',

        ]);
    }
}