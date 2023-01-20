<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class RequestIntegrity
{
    public function handle($request, Closure $next)
    {
        abort_if($request->header('x-organization-id') !=  config('services.client-bank.organization_id'), Response::HTTP_NOT_ACCEPTABLE, 'organization not found');
        abort_if($request->header('x-project-id') !=  config('services.client-bank.project_id'), Response::HTTP_NOT_ACCEPTABLE, 'project not found');
        abort_if(!$this->validateSignature($request->header('x-signature'), $request->all()), Response::HTTP_NOT_ACCEPTABLE, 'Invalid key');

        return $next($request);
    }

    private function validateSignature($signature, $data)
    {
        return sodium_crypto_sign_verify_detached(
            sodium_base642bin($signature, SODIUM_BASE64_VARIANT_URLSAFE_NO_PADDING),
            \Str::lower(request()->getMethod()).';user;'.json_encode($data),
            sodium_hex2bin(config('service.client-bank.public_key'))
        );
    }
}
