<?php

namespace App\Http\Controllers\Api;

use App\Enums\FriendRequestStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\FriendRequest;
use App\Services\FriendRequestService;
use App\Traits\HttpResponse;
use Exception;
use Illuminate\Http\JsonResponse;



class FriendRequestController extends Controller
{
    use HttpResponse;

    protected FriendRequestService $friendRequestService;

    public function __construct(FriendRequestService $friendRequestService)
    {
        $this->friendRequestService = $friendRequestService;
    }

    public function sendFriendRequest(FriendRequest $request): JsonResponse
    {
        try {

            $response = $this->friendRequestService->sendFriendRequest($request);

            if ($response['success']) {

                return $this->returnSuccessMessage(200, $response['message']);
            }
            return $this->returnErrorMessage(400, $response['message']);
        } catch (Exception $e) {
            return $this->returnErrorMessage(500, 'Error Sending Friend Request: ' . $e->getMessage());
        }
    }

    public function acceptFriendRequest(FriendRequest $request): JsonResponse
    {
        try {
            $response = $this->friendRequestService->acceptFriendRequest($request);
            if ($response['success']) {
                return $this->returnSuccessMessage(200, $response['message']);
            }
            return $this->returnErrorMessage(400, $response['message']);
        } catch (Exception $e) {
            return $this->returnErrorMessage(500, 'Error Accepting Friend Request: ' . $e->getMessage());
        }
    }

    public function declineFriendRequest(FriendRequest $request): JsonResponse
    {
        try {
            $response = $this->friendRequestService->declineFriendRequest($request);
            if ($response['success']) {
                return $this->returnSuccessMessage(200, $response['message']);
            }
            return $this->returnErrorMessage(400, $response['message']);
        } catch (Exception $e) {
            return $this->returnErrorMessage(500, 'Error Declining Friend Request: ' . $e->getMessage());
        }
    }

    public function cancelFriendRequest(FriendRequest $request): JsonResponse
    {
        try {
            $response = $this->friendRequestService->cancelFriendRequest($request);
            if ($response['success']) {
                return $this->returnSuccessMessage(200, $response['message']);
            }
            return $this->returnErrorMessage(400, $response['message']);
        } catch (Exception $e) {
            return $this->returnErrorMessage(500, 'Error Canceling Friend Request: ' . $e->getMessage());
        }
    }
}
