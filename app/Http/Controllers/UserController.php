<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends BaseController
{
    public function create()
    {

        return $this->respondWithSuccess();
    }

    public function index()
    {
        $user = User::factory()->count(10)->make()->toArray();

        return $this->respondWithSuccess($user);
    }
}
