<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersStatusesTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(UserTable::class);
        $this->call(AdvertsStatusesSeeder::class);
    }
}
