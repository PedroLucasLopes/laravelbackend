<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class PingController extends Controller
{
    public function ping()
    {
        return response()->json([
            'status' => true,
            'message' => 'Hello World!'
        ], 200);
    }
}
