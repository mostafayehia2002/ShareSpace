<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Models\User;
use App\Services\UserChangePasswordService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserChangePasswordController extends Controller
{
protected  UserChangePasswordService $passwordService;
    public function __construct(UserChangePasswordService $passwordService)
    {
        $this->passwordService=$passwordService;
    }
    public function index($email): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {

        return view('userAuth.change_password', compact('email'));
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        try {
            $response = $this->passwordService->changePassword($request);
            if ($response['success']) {
                toastr()->success($response['message']);
                return redirect()->route('login');
            }
            toastr()->error($response['message']);
            return redirect()->back()->withInput($request->only('email', 'code'));
        }catch (\Exception $exception){
            Log::error('Error changing password: ' . $exception->getMessage());
            toastr()->error('Failed to change password');
        }
    }
}
