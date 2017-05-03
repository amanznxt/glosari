<?php

use App\Lexicon;
use Illuminate\Database\Seeder;

class LexiconTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Lexicon::truncate();

        $path = storage_path('app/sql/lexicons.sql');
        DB::unprepared(file_get_contents($path));

        $path = storage_path('app/sql/lexicons-childs.sql');
        DB::unprepared(file_get_contents($path));
    }
}
