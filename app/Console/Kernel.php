<?php

namespace App\Console;

use App\Console\Commands\CheckPhraseCommand as CheckPhrase;
use App\Console\Commands\CleanUpDictionaryCommand as CleanUpDictionary;
use App\Console\Commands\FetchArticlesCommand as FetchArticles;
use App\Console\Commands\ResetUserPasswordCommand as ResetPassword;
use App\Console\Commands\ScarpDbpCommand as ScarpDbp;
use App\Console\Commands\SpellingCheckerCommand as CheckSpelling;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        CheckPhrase::class,
        CheckSpelling::class,
        CleanUpDictionary::class,
        FetchArticles::class,
        ScarpDbp::class,
        ResetPassword::class, // developer use
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
