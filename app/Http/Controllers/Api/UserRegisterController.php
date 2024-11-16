<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\UserRegisterService;
use App\Traits\HttpResponse;
use Illuminate\Support\Facades\Log;

class UserRegisterController
{
    use HttpResponse;
    protected UserRegisterService $registerUserService;

    public function __construct(UserRegisterService $registerUserService)
    {
        $this->registerUserService=$registerUserService;
    }

    public function register(RegisterRequest $request): \Illuminate\Http\JsonResponse
    {
        try{
            $response=  $this->registerUserService->register($request);
            if ($response['success']){

                return  $this->returnData(201,$response['message'],'data',new UserResource($response['user']));
            }
            return $this->returnErrorMessage(401,$response['message']);
        }catch (\Exception $e){
            Log::error('Error Register: ' . $e->getMessage());
            return  $this->returnErrorMessage(error:$e->getMessage());
        }
    }
}
