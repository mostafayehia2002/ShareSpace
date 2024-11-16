<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Services\UserChangePasswordService;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserChangePasswordController extends Controller
{
    use HttpResponse;
    protected  UserChangePasswordService $passwordService;
    public function __construct(UserChangePasswordService $passwordService)
    {
        $this->passwordService=$passwordService;
    }
    public function changePassword(ChangePasswordRequest $request)
    {
        try {
            $response = $this->passwordService->changePassword($request);
            if ($response['success']) {
              return  $this->returnSuccessMessage(200,$response['message']);
            }
            return  $this->returnErrorMessage(400,$response['message']);

        }catch (\Exception $exception){
            Log::error('Error changing password: ' . $exception->getMessage());
            toastr()->error('Failed to change password');
        }
    }

}
