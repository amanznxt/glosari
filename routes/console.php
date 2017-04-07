<?php

use App\Collocations\Core\Splitter;
use App\Dictionary;
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

Artisan::command('posts:fetch', function () {
    $posts = json_decode(file_get_contents('https://amanz.my/wp-json/wp/v2/posts'));
    $posts = collect($posts)->map(function ($post) {
        return [
            'title'   => $post->title->rendered,
            'article' => strip_tags($post->content->rendered),
            'url'     => $post->link,
            'user_id' => 1,
        ];
    });

    foreach ($posts as $post) {
        $this->info('Processing: ' . $post['title']);
        $exist = \App\Article::where('title', $post['title'])->first();
        if ($exist) {
            $this->error('Article already exist: ' . $post['title']);
        } else {
            $article = \App\Article::create($post);
            \App\Collocations\Core\Process::work($article->id);
        }
    }
    $this->info('Posts fetched and processed.');
})->describe('Fetch Amanz Latest Articles');
