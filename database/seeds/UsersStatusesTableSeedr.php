<?php

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = new \App\Models\UsersStatusModel();
        $role_user->id = '0';
        $role_user->title = 'не опубликовано';
        $role_user->save();

        $role_user = new \App\Models\UsersStatusModel();
        $role_user->id = '1';
        $role_user->title = 'работает';
        $role_user->save();

        $role_user = new \App\Models\UsersStatusModel();
        $role_user->id = '2';
        $role_user->title = 'временно заблокирован';
        $role_user->save();

        $role_user = new \App\Models\UsersStatusModel();
        $role_user->id = '3';
        $role_user->title = 'заблокирован';
        $role_user->save();

        $role_user = new \App\Models\UsersStatusModel();
        $role_user->id = '4';
        $role_user->title = 'удален';
        $role_user->save();

    }  
}
