<?php

namespace App\Console\Commands;

use App\Collocations\Core\Splitter;
use App\Dictionary;
use Illuminate\Console\Command;

class CleanUpDictionaryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dictionary:cleanup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean up dictionary from non-alphanumeric';

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
        $dictionaries = Dictionary::whereNotIn('name', Splitter::$delimeters)->get();
        foreach ($dictionaries as $dictionary) {
            $name  = $dictionary->name;
            $clean = Splitter::_cleanWord($name);

            if ($name != $clean) {
                $dictionary->name = $clean;
                $dictionary->save();
                $this->info('Clean up: ' . $name . ':' . $clean);
            }
        }
    }
}
