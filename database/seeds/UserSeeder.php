<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name'    => 'Administrator',
            'email'         => 'admin@cyberolympus.com',
            'password'      => bcrypt('cyberadmin'),
            'account_role'  => 'superadmin'
        ]);
    }
}
