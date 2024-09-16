<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QrCodeCaptureController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // TODO check existence inscription with id | false = break
        // TODO check if the race has started | false = break
        // TODO check if the race has not ended | false =  break
        // TODO check the last captured turn of inscription = int | NULL
        // TODO check the number of turns in the race is less than or equal to inscription turn | false = break
        // TODO if the captured turn is greater than 1, check whether the capture time is greater than the previous time
        // TODO calculate turn result
        // TODO create new QrCodeCapture
    }
}
