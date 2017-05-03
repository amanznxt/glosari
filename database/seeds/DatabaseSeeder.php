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
        /**
         * RBAC Seeder
         */
        $this->call(LaratrustSeeder::class);

        /**
         * Lexicons
         */
        $this->call(LexiconTableSeeder::class);

        /**
         * Spelling Rules from myEja
         */
        $this->call(SpellingRulesSeeder::class);

        /**
         * Seed Default Words
         */
        $this->call(WordSeeder::class);

        /**
         * Create Default User
         */
        $this->call(UserTableSeeder::class);
    }
}
