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
        $this->call(LaratrustSeeder::class);
        $this->call(SpellingRulesSeeder::class);
        $this->call(WordSeeder::class);
        $this->call(UserTableSeeder::class);
    }
}
