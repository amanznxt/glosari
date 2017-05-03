<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ScarpDbpCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrap:dbp {keyword}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrap DBP Site';

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
        $casper = resource_path('assets/js/casper.js');
        $this->info('Casper script location: ' . $casper);

        $keyword = $this->argument('keyword');

        // use this in case there's no PHANTOMJS_EXECUTABLE
        //putenv('PHANTOMJS_EXECUTABLE=/usr/local/bin/phantomjs');

        exec("casperjs $casper $keyword 2>&1", $output, $return_var);

        $output_json = implode("", $output);
        $decode      = json_decode($output_json);

        dd($decode);
    }
}
