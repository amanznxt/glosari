<?php

namespace App\Routes;

use Illuminate\Support\Facades\Route;

/**
 *    Setup Routes for Spelling
 */
class Spelling
{
    public static function routes()
    {
        Route::group([
            'prefix' => '',
            'middleware' => [],
        ], function () {
            Route::get('spellings/{id}', '\App\Http\Controllers\SpellingController@check')->name('check.spelling');
            Route::post('spellings/', '\App\Http\Controllers\SpellingController@store')->name('check.spelling.store');
        });
    }
}
