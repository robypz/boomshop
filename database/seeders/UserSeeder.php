<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::factory(1)->create();
        foreach ($users as $user) {
            $user->assignRole('admin');
        }

        $users = User::factory(1)->create();
        foreach ($users as $user) {
            $user->assignRole('operator');
        }

        $users = User::factory(1)->create();
        foreach ($users as $user) {
            $user->assignRole('client');
        }

        $superAdmin = new User;

        $superAdmin->name = 'Boom';
        $superAdmin->surname = 'Store';
        $superAdmin->nick = 'BoomStoreSA';
        $superAdmin->email = 'tiendasonlineb@gmail.com';
        $superAdmin->password = hash::make('B0om-St0r3#Sup3rAdm1n');
        $superAdmin->markEmailAsVerified();

        $superAdmin->save();

        $superAdmin->assignRole('super-admin');
    }
}
