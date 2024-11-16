<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Mail\ResetPassword;
use App\Models\User;
use App\Services\UserResetPasswordService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class UserResetPasswordController extends Controller
{
    protected UserResetPasswordService $passwordService;
    public function __construct(UserResetPasswordService $passwordService)
    {

        $this->passwordService=$passwordService;
    }
    public function index()
    {

        return view('userAuth.reset_password');
    }

    public function resetPassword(ResetPasswordRequest $request)
    {

        try {
           $response= $this->passwordService->resetPassword($request);
           if($response['success']) {

               toastr()->success($response['message']);
               return redirect()->route('edit_password', $request->input('email'));
           }
            toastr()->error($response['message']);
           return redirect()->back();
        } catch (\Exception $e) {
            Log::error('Error sending code: ' . $e->getMessage());
            toastr()->error('Failed to send code');
        }
    }








}
