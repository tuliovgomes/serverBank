<?php

namespace App\Providers;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Route;
use Dingo\Api\Contract\Auth\Provider;
use JWTAuth;

class ApiKeyProvider implements Provider
{
    protected $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function authenticate(Request $request, Route $route)
    {
        $apiKey = $request->input('api_key', $request->header('Api-Key'));
        $apiSecret = $request->input('api_secret', $request->header('Api-Secret'));

        abort_if(!$apiKey || !$apiSecret, 401, __('Unauthorized'));

        // Find user by api_key
        $user = $this->user->findByApiKey($apiKey);

        abort_if(!$user || !Hash::check($apiSecret, $user->api_secret), 401, __('Unauthorized'));

        config(['audit.user' => [
            'resolver' => function () use ($user) {
                return $user->id;
            },
        ]]);

        $token = JWTAuth::fromUser($user);

        return JWTAuth::setToken($token)->toUser();
    }
}
