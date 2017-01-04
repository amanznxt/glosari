<?php

use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
 */

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('reset:password', function () {
    DB::table('users')->update(['password' => bcrypt('password')]);
    $this->info('All users password has been reset to default - password');
})->describe('Reset all users password to default. Default passwor is password.');

Artisan::command('scrap:dbp {keyword}', function () {
    $casper = resource_path('assets/js/casper.js');
    $this->info('Casper script location: ' . $casper);

    $keyword = $this->argument('keyword');

    // use this in case there's no PHANTOMJS_EXECUTABLE
    //putenv('PHANTOMJS_EXECUTABLE=/usr/local/bin/phantomjs');

    exec("casperjs $casper $keyword 2>&1", $output, $return_var);

    $output_json = implode("", $output);
    $decode = json_decode($output_json);

    dd($decode);
})->describe('Scrap DBP Site');
