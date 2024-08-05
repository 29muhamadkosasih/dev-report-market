<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Superadmin',
            'email' => 'Superadmin@admin.com',
            'password' => bcrypt('password'),
            'role_id' => '1',
            'username' => 'Superadmin',
            'no_hp'  => '08558955539',
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user@user.com',
            'password' => bcrypt('password'),
            'role_id' => '2',
            'username' => 'User',
            'no_hp'  => '08558955539'
        ]);
    }
}