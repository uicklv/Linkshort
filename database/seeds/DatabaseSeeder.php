<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class, 10)->create();

        factory(\App\Link::class, 100)->create();

        factory(\App\Statistic::class, 1000)->create();
    }
}
