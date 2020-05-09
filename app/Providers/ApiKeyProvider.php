<?php

namespace App\Providers;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Route;
use Dingo\Api\Contract\Auth\Provider;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

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

        // Encontra o usuário pela Api Key
        $user = $this->user->findByApiKey($apiKey);
 
        abort_if(!$user, 401, __('Unauthorized'));
    }
}
