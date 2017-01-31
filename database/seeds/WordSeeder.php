<?php

use App\Dictionary;
use App\SpellingRule;
use Illuminate\Database\Seeder;
use Illuminate\Filesystem\Filesystem;

class WordSeeder extends Seeder
{
    protected $file;

    protected $rules;

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
        $this->rules = [
            'prefix' => SpellingRule::whereType('PFX')->get()->pluck('id', 'key')->toArray(),
            'suffix' => SpellingRule::whereType('SFX')->get()->pluck('id', 'key')->toArray(),
        ];

        Dictionary::truncate();
        $wordsRaw = $this->file->get(database_path('seeds/ms-MY.dic'));
        $words = explode("\n", $wordsRaw);
        # Enhancement Proposal
        // find duplicate words
        // if any, discard from the array
        // AND
        // need to check by batch - 1k words at one time
        // $duplicates = Dictionary::whereIn('name', $words)->get(['name', 'id'])->toArray();
        foreach ($words as $key => $value) {

            $word = preg_replace("/\/[A-z]*/", "", $value);
            $word = trim($word);
            # Enhancement Proposal
            // there must be a better way to insert data
            // bulk insert is a solution,
            // but need to check on duplication
            // if there's duplicate, don't insert
            $dictionary = Dictionary::firstOrCreate(['name' => $word]);

            // attach rules if any
            $rules = explode('/', $value);
            if (isset($rules[1])) {
                $characters = str_split($rules[1]);
                foreach ($characters as $character) {
                    if (ctype_upper($character)) {
                        if (isset($this->rules['prefix'][$character])) {
                            $rule_id = $this->rules['prefix'][$character];

                            if ($rule_id) {
                                $dictionary->rules()->attach($rule_id);
                                $this->command->comment('Attached Prefix Rule: ' . $rule_id . ' to ' . $dictionary->id);
                            }
                        } else {
                            $this->command->error('Prefixed rule not exist for ' . $character);
                        }
                    } else {
                        if (isset($this->rules['suffix'][$character])) {
                            $rule_id = $this->rules['suffix'][$character];

                            if ($rule_id) {
                                $dictionary->rules()->attach($rule_id);
                                $this->command->comment('Attached Suffix Rule: ' . $rule_id . ' to ' . $dictionary->id);
                            }
                        } else {
                            $this->command->error('Suffixed rule not exist for ' . $character);
                        }
                    }
                }
            }

            $this->command->info('Imported ' . $dictionary->name);
        }
    }
}
