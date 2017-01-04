<?php

namespace App\Routes\API;

use Illuminate\Support\Facades\Route;

/**
 *    Setup Routes for Scrapper
 */
class Scrapper
{
    public static function routes()
    {
        Route::group([
            'prefix' => '',
            'middleware' => [],
        ], function () {
            Route::get('scrap/{keyword}', '\App\Http\Controllers\API\ScrapperController@scrap');
        });
    }
}
