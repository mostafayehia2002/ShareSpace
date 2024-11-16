<?php

namespace App\Services;

use App\Http\Requests\ChangePasswordRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserChangePasswordService
{

    public function changePassword(ChangePasswordRequest $request): array
    {
        $user = User::where('email', $request->input('email'))->first();
        if ($user){
            if($user->code==$request->input('code')) {
               $user->update([
                    'password' => Hash::make($request->input('password')),
                    'code' => null,
                ]);
               return [
                        'success' => true,
                        'message' => __('messages.success_change_password')
                    ];
            }else {
                    return [
                        'success' => false,
                        'message' => __('messages.failure_change_password')
                    ];
                }

        }
        return[
            'success'=>false,
            'message'=>__('messages.failure_user')
        ];

    }

}
