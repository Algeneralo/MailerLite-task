<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Factories\SubscriberFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        SubscriberFactory::new()->count(50)->create();
    }
}
