<?php

use Illuminate\Database\Seeder;

class AdvertsStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = new \App\Models\AdvertsStatusModel();
        $role_user->id = 1;
        $role_user->title = 'не опубликовано';
        $role_user->save();

        $role_user = new \App\Models\AdvertsStatusModel();
        $role_user->id = 2;
        $role_user->title = 'на модерации';
        $role_user->save();

        $role_user = new \App\Models\AdvertsStatusModel();
        $role_user->id = 3;
        $role_user->title = 'опубликовано';
        $role_user->save();

        $role_user = new \App\Models\AdvertsStatusModel();
        $role_user->id = 4;
        $role_user->title = 'в архиве';
        $role_user->save();

        $role_user = new \App\Models\AdvertsStatusModel();
        $role_user->id = 5;
        $role_user->title = 'удаленно';
        $role_user->save();
    }
}
