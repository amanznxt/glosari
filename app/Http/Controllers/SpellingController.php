<?php

namespace App\Http\Controllers;

use App\Article;
use App\Collocations\Core\Process;
use App\Dictionary;

// use App\SpellingRule;

class SpellingController extends Controller
{
    public function check($id)
    {
        $article = Article::find($id);
        $words = Process::work($id, true);
        $results = [];

        foreach ($words as $word) {
            $search = Dictionary::where('name', $word)
                ->get(['name'])
                ->pluck('name')
                ->toArray();

            $suggest = null;

            if (empty($search)) {
                $suggest = Dictionary::where('name', 'like', '%' . $word . '%')
                    ->orderBy('name')
                    ->get(['name'])
                    ->pluck('name')
                    ->toArray();
            }

            // check if already record, don't store
            if (!$this->duplicate($results, $word)) {
                $results[] = [
                    'word' => $word,
                    'status' => !empty($search) ? true : false,
                    'suggest' => $suggest,
                ];
            }

        }

        // highlight those syntax errors
        foreach ($results as $key => $value) {
            if (!$value['status']) {
                if ($value['suggest']) {
                    $class = 'syntax-suggest';
                } else {
                    $class = 'syntax-no-suggest';
                }
                $article->article = str_replace($value['word'],
                    '<span class="syntax ' . $class . '">' . $value['word'] . '</span>',
                    $article->article);
            }
        }

        // do check each word for it spellings
        // $suffixes = SpellingRule::where('type', 'SFX')->get(['key', 'value', 'contain'])->pluck('value')->toArray();
        // $prefixes = SpellingRule::where('type', 'PFX')->get(['key', 'value', 'contain'])->pluck('value')->toArray();
        return view('spellings.check', compact('results', 'article'));
    }

    private function duplicate($results, $word)
    {
        $duplicate = false;
        foreach ($results as $result) {
            if ($word == array_get($result, 'word')) {
                $duplicate = true;
                break;
            }
        }
        return $duplicate;
    }

    public function store()
    {
        dd(request()->input());
    }
}
