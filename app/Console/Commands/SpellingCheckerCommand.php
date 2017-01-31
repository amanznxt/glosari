<?php

namespace App\Console\Commands;

use App\Dictionary;
use Illuminate\Console\Command;

class SpellingCheckerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'spelling:check
                            {word* : List of Bahasa Melayu words to check}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check Bahasa Melayu Spelling';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $words = $this->argument('word');
        $errors = [];
        // fetch possible words available
        // get the exact word exist
        // if none exist, check most likely the right spelling
        // and suggest to end user
        $results = [];
        foreach ($words as $word) {
            $results[] = [
                'word' => $word,
                'search' => Dictionary::where('name', $word)
                    ->get(['name'])
                    ->pluck('name')
                    ->toArray(),
                'suggest' => Dictionary::where('name', 'like', '%' . $word . '%')
                    ->get(['name'])
                    ->pluck('name')
                    ->toArray(),
            ];
        }
        dd($results);
    }
}
