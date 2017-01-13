<?php

namespace App\Routes;

use Illuminate\Support\Facades\Route;

/**
 *    Setup Routes for Dictionary
 */
class Dictionary
{
    public static function routes()
    {
        Route::group([
            'prefix' => '',
            'middleware' => [],
        ], function () {
            Route::put('dictionaries/lexicon', '\App\Http\Controllers\DictionaryController@setWordLexicon')
                ->name('dictionaries.updateLexicon');
            Route::resource('dictionaries', '\App\Http\Controllers\DictionaryController');
        });
    }
}
