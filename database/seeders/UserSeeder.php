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
        $superAdmin = new User;

        $superAdmin->name = 'Boom';
        $superAdmin->surname = 'Store';
        $superAdmin->nick = 'BoomStoreSA';
        $superAdmin->email = 'root@example.com';
        $superAdmin->password = hash::make('1234567890');
        $superAdmin->markEmailAsVerified();

        $superAdmin->save();

        $superAdmin->assignRole('super-admin');
    }
}
