<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Services\UserLoginService;
use App\Traits\HttpResponse;
use Illuminate\Support\Facades\Log;


class UserLoginController extends Controller
{
 use HttpResponse;
    public UserLoginService $loginService;

    public function __construct(UserLoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function login(LoginRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            $response = $this->loginService->login($request);
            if($response['success']) {
               return $this->returnData(200,
                   $response['message'],
                   'data',
                      new UserResource($response['user']),
                   );
            }
            return $this->returnErrorMessage(401, $response['message']);
        }catch (\Exception $e){
            Log::error('Error  Login: ' . $e->getMessage());
            return  $this->returnErrorMessage(error:$e->getMessage());
        }
    }
}
