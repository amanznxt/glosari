<?php

namespace App\Http\Controllers;

use App\Article;
use App\Dictionary;
use App\Word;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dictionary_count = Dictionary::all()->count();
        $article_count    = Article::all()->count();
        $word_count       = Word::all()->count();
        return view('home', compact('dictionary_count', 'article_count', 'word_count'));
    }
}
