<?php

namespace App\Providers;

use Exception;
use Yampi\Api\AuthRequest;
use Illuminate\Support\ServiceProvider;

class YampiApiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AuthRequest::class, function () {
            $url = config('services.yampi-api.url');
            $token = config('services.yampi-api.token');

            if (!$token) {
                throw new Exception('Yampi API Token not configured');
            }

            return AuthRequest::url($url)->setUserToken($token);
        });
        $this->app->bind('api', AuthRequest::class);
    }
}
