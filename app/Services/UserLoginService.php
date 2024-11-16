<?php

namespace App\Services;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class UserLoginService
{
    protected TokenService $tokenService;
    public function __construct(TokenService $tokenService)
    {
        $this->tokenService = $tokenService;
    }
    public function login(LoginRequest $request): array
    {
        $credentials = $request->only(['email', 'password']);
        $remember = $request->has('remember');
        if (Auth::attempt($credentials, $remember)) {
            $user = auth()->user();
            $user->token=$this->tokenService->createApiToken($request,$user);
            return[
                'success' => true,
                'message' => __('messages.success_login'),
                'user' => $user,
            ];
        }
        return [
            'success' => false,
            'message' => __('messages.failure_login')
        ];
    }
}
