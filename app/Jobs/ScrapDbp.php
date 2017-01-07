<?php

namespace App\Jobs;

use App\Collocations\Dbp\Scrap;
use App\Dictionary;
use App\Lexicon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ScrapDbp implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $dictionary;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Dictionary $dictionary)
    {
        $this->dictionary = $dictionary;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (empty($this->dictionary->lexicon_id)) {
            $scrap = Scrap::now($this->dictionary->name);
            if ($scrap) {
                $lexicon = Lexicon::where('name', 'like', '%' . $scrap->type . '%')->first();

                if ($lexicon) {
                    $this->dictionary->lexicon_id = $lexicon->id;
                    $this->dictionary->save();
                }
            }
            // send email notification on success or fail
        }
    }

    /**
     * The job failed to process.
     *
     * @param  Exception  $exception
     * @return void
     */
    public function failed(Exception $exception)
    {
        // Send user notification of failure, etc...
    }
}
