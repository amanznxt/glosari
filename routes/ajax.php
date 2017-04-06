<?php

/**
 * Main module of Dictionary
 */
Route::resource('dictionaries', 'DictionaryController');

/**
 * Sub modules of Dictionary
 */
Route::group(['namespace' => 'Dictionary', 'prefix' => 'dictionaries', 'as' => 'dictionaries.'], function () {
    /**
     * Sub modules of Dictionary > Words
     */
    Route::group(['namespace' => 'Word', 'prefix' => 'words', 'as' => 'words.'], function () {
        /**
         * Get Word's Lexicon
         */
        Route::get('lexicons', 'LexiconController@show')->name('lexicons.show');

        /**
         * Update Word's Lexicon
         */
        Route::put('lexicons', 'LexiconController@update')->name('lexicons.update');
    });
});
