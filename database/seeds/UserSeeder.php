<?php

use App\User;
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
        // make super admin
        $super_admin = User::create([
            'first_name' => 'Anas',
            'last_name'  => 'Omar',
            'email' => 'super_admin@gmail.com',
            'password' => Hash::make(123123),
        ]);

        $super_admin->attachRole('super_admin');

        // make some admins
        $reader = User::create([
            'first_name'    =>  'wesam',
            'last_name'     =>  'omar',
            'email'         =>  'wesam@gmail.com',
            'password'      =>  bcrypt(123123),
        ]);
        $reader->attachRole('admin');
        $reader->syncPermissions(['read_users']);

        $reader_updater = User::create([
            'first_name'    =>  'mohamad',
            'last_name'     =>  'omar',
            'email'         =>  'mohamad@gmail.com',
            'password'      =>  bcrypt(123123),
        ]);
        $reader_updater->attachRole('admin');
        $reader_updater->syncPermissions(['read_users', 'update_users']);

        $updater = User::create([
            'first_name'    =>  'eman',
            'last_name'     =>  'omar',
            'email'         =>  'eman@gmail.com',
            'password'      =>  bcrypt(123123),
        ]);
        $updater->attachRole('admin');
        $updater->syncPermissions(['update_users']);

        $updater_deleter = User::create([
            'first_name'    =>  'yousef',
            'last_name'     =>  'omar',
            'email'         =>  'yousef@gmail.com',
            'password'      =>  bcrypt(123123),
        ]);
        $updater_deleter->attachRole('admin');
        $updater_deleter->syncPermissions(['update_users', 'delete_users']);

        $c_d = User::create([
            'first_name'    =>  'esam',
            'last_name'     =>  'osama',
            'email'         =>  'esam@gmail.com',
            'password'      =>  bcrypt(123123),
        ]);
        $c_d->attachRole('admin');
        $c_d->syncPermissions(['create_users', 'delete_users', 'create_categories']);

        $c_d_2 = User::create([
            'first_name'    =>  'ansam',
            'last_name'     =>  'osama',
            'email'         =>  '$c_d_2@gmail.com',
            'password'      =>  bcrypt(123123),
        ]);
        $c_d_2->attachRole('admin');
        $c_d_2->syncPermissions(['create_users', 'delete_users', 'update_users', 'create_categories']);


        // create client
        $client = User::create([
            'first_name'    =>  'karam',
            'last_name'     =>  'osama',
            'email'         =>  'karam@gmail.com',
            'password'      =>  bcrypt(123123),
        ]);
        $client->attachRole('client');
    } //-- end run
} //-- end user seeder}
