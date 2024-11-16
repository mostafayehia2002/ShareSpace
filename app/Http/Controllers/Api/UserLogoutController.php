<?php

namespace App\Http\Controllers\Api;

use App\Services\UserLogoutService;
use App\Traits\HttpResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class UserLogoutController
{
    use HttpResponse;
    public UserLogoutService $logoutService;

    public function __construct(UserLogoutService $logoutService)
    {
        $this->logoutService = $logoutService;
    }
    public function logout(Request $request): \Illuminate\Http\JsonResponse
    {
        try {

            $response=$this->logoutService->logout($request);

            if($response['success']){

                return $this->returnSuccessMessage(200,$response['message']);
            }

            return $this->returnErrorMessage(401,$response['message']);

        }catch (\Exception $e){
            Log::error('Error  Logout: ' . $e->getMessage());
            return  $this->returnErrorMessage(error:$e->getMessage());
        }
    }
}
