<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use App\Services\UserResetPasswordService;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserResetPasswordController extends Controller
{
    use HttpResponse;
    protected UserResetPasswordService $passwordService;
    public function __construct(UserResetPasswordService $passwordService)
    {

        $this->passwordService=$passwordService;
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        try {
            $response= $this->passwordService->resetPassword($request);
            if($response['success']) {
                return $this->returnSuccessMessage(200,$response['message']);
            }
            return  $this->returnErrorMessage(400,$response['message']);
         } catch (\Exception $e) {
            Log::error('Error sending code: ' . $e->getMessage());
            toastr()->error('Failed to send code');
        }
    }
}
