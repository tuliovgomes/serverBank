<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PingController extends BaseController
{
    public function ping()
    {
        return [
            'data' => [
                'message' => 'Everything is going to be 200 OK',
            ],
        ];
    }
}
