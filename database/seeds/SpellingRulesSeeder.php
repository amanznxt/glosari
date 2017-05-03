<?php

use App\SpellingRule;
use Illuminate\Database\Seeder;
use Illuminate\Filesystem\Filesystem;

class SpellingRulesSeeder extends Seeder
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
        SpellingRule::truncate();
        $this->fetch('prefix', 'PFX');
        $this->fetch('suffix', 'SFX');
    }

    private function fetch($type, $label)
    {
        $this->command->error('Fetching ' . $type . '(' . $label . ')...');

        $path     = storage_path('app/seeds/' . $type . '.aff');
        $content  = $this->file->get($path);
        $prefixes = explode("\n", $content);

        foreach ($prefixes as $prefix) {
            $rule = $this->transform($prefix);

            if ($rule) {
                $rule['type'] = $label;

                $this->command->info('Key: ' . $rule['key']);
                $this->command->info('Value: ' . $rule['value']);
                $this->command->info('Contain: ' . $rule['contain']);
                $this->command->info('Raw: ' . $rule['raw']);

                SpellingRule::firstOrCreate($rule);

                $this->command->comment(str_repeat('-', 80));
            }
        }
    }

    private function transform($prefix)
    {
        $explode = explode(" ", $prefix);
        if ($explode[2] == 'Y') {
            return false;
        }
        return [
            'type'    => null,
            'key'     => $explode[1],
            'value'   => $explode[3],
            'contain' => isset($explode[4]) ? $explode[4] : null,
            'raw'     => $prefix,
        ];
    }
}
