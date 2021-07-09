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
        // $this->call(UserSeeder::class);
        $this->call([
            ApartmentsTableSeeder::class,
            MessagesTableSeeder::class,
            ServicesTableSeeder::class,
            SponsorsTableSeeder::class,
        ]);
    }
}
