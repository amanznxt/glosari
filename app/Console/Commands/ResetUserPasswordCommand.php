<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ResetUserPasswordCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:password  {emails=}  --all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset All or specified users (by email)';

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
        if ($this->option('all')) {
            DB::table('users')
                ->update(['password' => bcrypt('password')]);
            $this->info('All users password has been reset to default - password');
        } else {
            DB::table('users')
                ->whereEmailIn($this->argument('emails'))
                ->update(['password' => bcrypt('password')]);
            $this->info('Mentioned users password has been reset to default - password');
        }

    }
}
