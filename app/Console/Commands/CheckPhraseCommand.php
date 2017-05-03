<?php

namespace App\Console\Commands;

use App\Collocations\Core\Splitter;
use App\Dictionary;
use Illuminate\Console\Command;

class CheckPhraseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:phrase';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Validate phrases given.';

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
        // get lexicon each words
        $paragraphs = ['Microsoft sebelum ini sedia menjanjikan bakal menawarkan kemaskini Windows 10 Creators Update secara manual kepada pengguna seminggu lebih awal, dan seperti dijanjikan, kini ia telah mula ditawarkan.'];

        $sentences = Splitter::paragraphsToSentences($paragraphs);
        $words     = Splitter::sentencesToWords($sentences);

        // $words  = array_diff($words, Splitter::$delimeters);
        $_words = [];
        $_tags  = [];
        foreach ($words as $word) {

            $dictionary = Dictionary::firstOrCreate(['name' => $word]);

            if ($dictionary->lexicon) {
                $_words[$word] = $dictionary->lexicon->tag;
                $_tags[]       = $dictionary->lexicon->tag;
            }

            // if (!in_array($word, Splitter::$delimeters)) {
            //     $this->info('Scrap from DBP: ' . $word);
            //     $scrap = Scrap::now($word);
            //     if ($scrap) {
            //         $dictionary->lexicon_id = Lexicon::where('name', $scrap->type)->first()->id;
            //         $dictionary->save();
            //     }
            //     $_words[] = $scrap;
            // }
        }
        dd($_words, $_tags);
        // get rules related to word's lexicon

        $prefixes = App\SpellingRule::whereType('PFX')->get()->map(function ($rule) {
            return [
                'key'   => $rule->key,
                'value' => $rule->value,
                'regex' => $rule->contain,
            ];
        });

        $suffixes = App\SpellingRule::whereType('SFX')->get()->map(function ($rule) {
            return [
                'key'   => $rule->key,
                'value' => $rule->value,
                'regex' => $rule->contain,
            ];
        });
    }
}
