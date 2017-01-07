<?php

namespace App\Http\Controllers\API;

use App\Collocations\Dbp\Scrap;
use App\Http\Controllers\Controller;

class ScrapperController extends Controller
{
    public function scrap($keyword)
    {
        return response()->json([
            'data' => Scrap::now($keyword),
        ]);
    }
}
