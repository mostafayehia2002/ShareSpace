<?php

namespace App\Http\Controllers;

use App\Http\Requests\FriendRequest;
use App\Models\User;
use App\Services\FriendService;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FriendController extends Controller
{
    protected  FriendService $friendService;
public function __construct(FriendService $friendService)
{
    $this->friendService=$friendService;

}

    public function getUsersWithFriendStatus()
    {
        try {
          $users=  $this->friendService->getUsersWithFriendStatus();

          return view('pages.friends', compact('users'));

        }catch (Exception $e){
            Log::error('Error get  Friends : ' . $e->getMessage());
            toastr()->error($e->getMessage());
        }



    }

    //if you want to delete user from your friends
    public function removeFriend(FriendRequest $request): \Illuminate\Http\RedirectResponse
    {
        try {
            $response=$this->friendService->removeFriend($request);
            if($response['success']){
                toastr()->success($response['message']);
            }
            toastr()->error($response['message']);
        } catch (Exception $e) {
            Log::error('Error Removeing Friend : ' . $e->getMessage());
            toastr()->error($e->getMessage());
        }

        return redirect()->back();
    }


}
