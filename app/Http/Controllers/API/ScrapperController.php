<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

class ScrapperController extends Controller
{
    public function scrap($keyword)
    {
        $casper = resource_path('assets/js/casper.js');

        // use this in case there's no PHANTOMJS_EXECUTABLE
        //putenv('PHANTOMJS_EXECUTABLE=/usr/local/bin/phantomjs');

        exec("casperjs $casper $keyword 2>&1", $output, $return_var);

        $output_json = implode("", $output);
        $decode = json_decode($output_json);
        $decode->type = title_case($decode->type);

        return response()->json([
            'data' => $decode,
        ]);
    }
}
