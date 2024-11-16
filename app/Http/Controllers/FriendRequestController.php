<?php

namespace App\Http\Controllers;

use App\Enums\FriendRequestStatus;
use App\Http\Requests\FriendRequest;
use App\Services\FriendRequestService;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FriendRequestController extends Controller
{
    //
    protected FriendRequestService $friendRequestService;

    public function __construct(FriendRequestService $friendRequestService)
    {
        $this->friendRequestService = $friendRequestService;
        $this->middleware('auth');
    }

    public function sendFriendRequest(FriendRequest $request): \Illuminate\Http\RedirectResponse
    {
        try{
            $response = $this->friendRequestService->sendFriendRequest( $request);
            if ($response['success']) {
                toastr()->success($response['message']);
            }else{
                toastr()->error($response['message']);
            }

        }catch (\Exception $e) {
            Log::error('Error Sending Friend Request: ' . $e->getMessage());
            toastr()->error($e->getMessage());
        }
        return redirect()->back();
    }

    //accept friend request
    public function acceptFriendRequest(FriendRequest $request): \Illuminate\Http\RedirectResponse
    {
        try {
            $response = $this->friendRequestService->acceptFriendRequest($request);
            if ($response['success']) {
                toastr()->success($response['message']);
            } else {
                toastr()->error($response['message']);
            }
        } catch (Exception $e) {
            Log::error('Error Accepting Friend Request: ' . $e->getMessage());
            toastr()->error($e->getMessage());
        }
        return redirect()->back();
    }

    //if you dont accept friend request of any user
    public function declineFriendRequest(FriendRequest $request): \Illuminate\Http\RedirectResponse
    {
        try {
            $response = $this->friendRequestService->declineFriendRequest($request);
            if ($response['success']) {
                toastr()->success($response['message']);
            } else {
                toastr()->error($response['message']);
            }
        } catch (Exception $e) {
            Log::error('Error Declining Friend Request: ' . $e->getMessage());
            toastr()->error($e->getMessage());
        }
        return redirect()->back();
    }

    //if you send friend request to user and want to delete friend request
    public function cancelFriendRequest(FriendRequest $request): \Illuminate\Http\RedirectResponse
    {
        try {
            $response = $this->friendRequestService->cancelFriendRequest($request);
            if ($response['success']) {
                toastr()->success($response['message']);
            } else {
                toastr()->error($response['message']);
            }
        } catch (Exception $e) {
            Log::error('Error Canceling Friend Request: ' . $e->getMessage());
            toastr()->error($e->getMessage());
        }
        return redirect()->back();
    }
}
