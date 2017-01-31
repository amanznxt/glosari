<?php

use App\Dictionary;
use Illuminate\Database\Seeder;
use Illuminate\Filesystem\Filesystem;

class WordSeeder extends Seeder
{
    protected $file;

    public function __construct(Filesystem $file)
    {
        $this->file = $file;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $wordsRaw = $this->file->get(database_path('seeds/ms-MY.dic'));
        $words = explode("\n", $wordsRaw);
        # Enhancement Proposal
        // find duplicate words
        // if any, discard from the array
        // AND
        // need to check by batch - 1k words at one time
        // $duplicates = Dictionary::whereIn('name', $words)->get(['name', 'id'])->toArray();
        foreach ($words as $key => $value) {
            $value = preg_replace("/\/[A-z]*/", "", $value);
            $word = trim($value);
            # Enhancement Proposal
            // there must be a better way to insert data
            // bulk insert is a solution,
            // but need to check on duplication
            // if there's duplicate, don't insert
            $dictionary = Dictionary::firstOrCreate(['name' => $word]);
            $this->command->info('Imported ' . $dictionary->name);
        }
    }
}
