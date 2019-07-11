<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;



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
            'first_name'        => 'Admin',
            'last_name'         => 'Istrator',
            'email'             => 'admin@admin.com',
            'password'          => Hash::make(  'password'),
        ]);

        \App\Collector::create([
           'name' => 'Ferdinand Manegos'
        ]);


        \App\Collector::create([
            'name' => 'Marilla Manegos'
        ]);
    }
}
