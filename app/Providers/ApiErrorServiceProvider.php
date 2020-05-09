<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ApiErrorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $handler = app('Dingo\Api\Exception\Handler');

        $handler->register(function (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->notFound();
        });

        $handler->register(function (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e) {
            return $this->notFound();
        });

        $handler->register(function (\Illuminate\Auth\AuthenticationException $e) {
            return response()->make(['message' => 'Unauthorized', 'status_code' => 401], 401);
        });

        if (app()->env == 'production') {
            if (!config('app.debug')) {
                $handler->register(function (\Exception $e) {
                    if (!$e instanceof \Dingo\Api\Exception\ResourceException &&
                        !$e instanceof \Symfony\Component\HttpKernel\Exception\BadRequestHttpException &&
                        !$e instanceof \Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException &&
                        !$e instanceof \Symfony\Component\HttpKernel\Exception\HttpException
                    ) {
                        report($e);
                        
                        return response()->make([
                            'message' => 'Internal server error',
                            'status_code' => 500
                        ], 500);
                    }
                });
            }
        }
    }

    private function notFound()
    {
        return response()->make(['message' => 'Resource not found', 'status_code' => 404], 404);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
