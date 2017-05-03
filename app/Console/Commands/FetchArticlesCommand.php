<?php

namespace App\Console\Commands;

use App\Article;
use Carbon\Carbon;
use Illuminate\Console\Command;

class FetchArticlesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'articles:fetch {per_page=10} {--reverse}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch Amanz Articles';

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
        // Enhancement: if per_page is more than 100,
        // need to separate the process to batches of 100 records for each batch

        $params   = [];
        $params[] = 'per_page=' . $this->argument('per_page');

        if ($this->option('reverse') === true) {
            $carbonDate = Article::orderBy('date', 'asc')->first(['date']);

            if ($carbonDate) {
                $d        = $carbonDate->date->toIso8601String();
                $params[] = 'before=' . remove_utc_hours($d);
                $this->comment('Fetching posts before ' . remove_utc_hours($d));
            }
        } else {
            $carbonDate = Article::orderBy('date', 'desc')->first(['date']);

            if ($carbonDate) {
                $d        = $carbonDate->date->toIso8601String();
                $params[] = 'after=' . remove_utc_hours($d);
                $this->comment('Fetching posts after ' . remove_utc_hours($d));
            }
        }

        $query_string = join('&', $params);
        $posts        = json_decode(file_get_contents('https://amanz.my/wp-json/wp/v2/posts?' . $query_string));
        $posts        = collect($posts)->map(function ($post) {
            return [
                'title'   => html_entity_decode(remove_emoji($post->title->rendered)),
                'article' => remove_emoji(strip_tags($post->content->rendered)),
                'url'     => $post->link,
                'date'    => (new Carbon($post->date))->toDateTimeString(),
                'user_id' => 1,
            ];
        });

        foreach ($posts as $post) {
            $this->info('Processing: ' . $post['title']);
            $exist = Article::where('title', $post['title'])->first();
            if ($exist) {
                $this->error('Article already exist: ' . $post['title']);
            } else {
                $article = \App\Article::create($post);
                \App\Collocations\Core\Process::work($article->id);
            }
        }
        $this->info('Posts fetched and processed.');
    }
}
