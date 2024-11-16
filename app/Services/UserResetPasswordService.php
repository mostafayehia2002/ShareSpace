<?php

namespace App\Services;

use App\Http\Requests\ResetPasswordRequest;
use App\Mail\ResetPassword;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class UserResetPasswordService
{

    public function resetPassword(ResetPasswordRequest $request): array
    {
            $email = $request->input('email');
            //make random degit
            $code = rand(1111, 9999);
            //get user
            $user = User::where('email', $email)->first();
            //save code to database
             $send_code= $user->update(['code' => $code]);
            //send code to mail
            $url = request()->getSchemeAndHttpHost() . "/change/password/$email";
           $send_mail=Mail::to($email)->send(new ResetPassword($code, $url, $user->name));
            if($send_code && $send_mail){
                return[
                    'success'=>true,
                    'message'=>__('messages.success_send_code'),
                ];
            }
        return[
            'success'=>false,
            'message'=>__('messages.failure_send_code'),
        ];


    }

}
