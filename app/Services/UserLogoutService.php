<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserLogoutService
{
    public function logout(Request $request):array
    {
        if(isApiRequest(request())){
         $request->user()->currentAccessToken()->delete();
            return [
                'success' => true,
                'message' => trans('messages.success_logout')
            ];
         }elseif (Auth::guard('web')->check()){
            Auth::logout();
            return [
                'success' => true,
                'message' => trans('messages.success_logout')
            ];
        }
        return [
            'success' => false,
            'message' => trans('messages.failure_logout')
        ];

    }

}
