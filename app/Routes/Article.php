<?php

namespace App\Routes;

use Illuminate\Support\Facades\Route;

/**
 *    Setup Routes for Article
 */
class Article
{
    public static function routes()
    {
        Route::group([
            'prefix' => '',
            'middleware' => ['active', 'auth'],
        ], function () {
            Route::resource('articles', '\App\Http\Controllers\ArticleController');
            Route::get('articles/process/{id}', '\App\Http\Controllers\ArticleController@process')->name('articles.process');
        });
    }
}
