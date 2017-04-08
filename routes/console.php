<?php

use App\Article;
use App\Collocations\Core\Splitter;
use App\Dictionary;
use Carbon\Carbon;
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
    $decode      = json_decode($output_json);

    dd($decode);
})->describe('Scrap DBP Site');

Artisan::command('check:phrase', function () {

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

    // check validity based on rules given
})->describe('Validate phrase given.');

Artisan::command('posts:fetch {per_page=10} {--reverse}', function () {

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
})->describe('Fetch Amanz Latest Articles');

Artisan::command('dictionary:cleanup', function () {
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
})->describe('Clean up dictionaries from non-alphanumer');
