<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FriendRequest;
use App\Models\User;
use App\Services\FriendService;
use App\Traits\HttpResponse;
use Exception;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    use HttpResponse;
    protected  FriendService $friendService;
    public function __construct(FriendService $friendService)
    {
        $this->friendService=$friendService;

    }

    public function getUsersWithFriendStatus()
    {
        try {
           $users=$this->friendService->getUsersWithFriendStatus();

            return  $this->returnPaginatedData($users);

        }catch (Exception $e){

            return $this->returnErrorMessage(error:$e->getMessage());
        }

    }

    public function removeFriend(FriendRequest $request): \Illuminate\Http\JsonResponse
    {

        try {
            $response=$this->friendService->removeFriend($request);
            if($response['success']){
                return $this->returnSuccessMessage(200,$response['message']);
            }
            return $this->returnErrorMessage(400,$response['message']);
        }catch (Exception $e){

            return $this->returnErrorMessage(error:$e->getMessage());
        }


    }
}
