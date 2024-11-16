<?php

namespace App\Services;

class TokenService
{
    public function createApiToken($request,$user): ?string
    {
        if(isApiRequest($request)) {

            return $user->createToken('MyAppToken')->plainTextToken;
        }
        return null;
    }
}
