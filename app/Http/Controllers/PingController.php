<?php

namespace App\Http\Controllers;

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
