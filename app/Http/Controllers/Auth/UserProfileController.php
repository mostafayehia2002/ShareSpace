<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use App\Services\UserUpdateProfileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    protected UserUpdateProfileService $profileService;

    public function __construct(UserUpdateProfileService $profileService)
    {
        $this->profileService=$profileService;
    }
    public function editProfile(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('userAuth.edit_profile');
    }

    public function updateProfile(UpdateProfileRequest $request)
    {

        try {
          $response= $this->profileService->updateProfile($request);
          if($response['success']) {

              toastr()->success($response['message']);
          }

            return redirect()->back()->withInput($request->only('name', 'email'));
        } catch (\Exception $e) {
            Log::error('Error updating profile: ' . $e->getMessage());
            toastr()->error('faild to update data');
        }
    }


    public function viewUserProfile($id)
    {
        $user=auth()->user();
        $friendsIdsArray = $user->getFriends();
        $friendsIdsString = !empty($friendsIdsArray) ? implode(',', $friendsIdsArray) : '0';
        $sentRequestsIds = $user->sentFriendRequests->where('status', 'pending')->pluck('receiver_id')->toArray();
        $sentRequestsIdsString = !empty($sentRequestsIds) ? implode(',', $sentRequestsIds) : '0';
        $FriendRequestsIds = $user->receivedFriendRequests->where('status', 'pending')->pluck('sender_id')->toArray();
        $FriendRequestsIdsString = !empty($FriendRequestsIds) ? implode(',', $FriendRequestsIds) : '0';
        // Get all sent friend requests' IDs as a comma-separated string
        $user = DB::table('users')
            ->leftJoin('media', function ($join) {
                $join->on('users.id', '=', 'media.mediable_id')
                    ->where('media.mediable_type', '=', 'App\\Models\\User');
            })
            ->where('users.id', $id)
            ->select('users.*', 'media.file_path')->addSelect([
                //هل هم اصدقاء
                DB::raw("IF(users.id IN ( $friendsIdsString) , 1, 0) as is_friends"),
                // ارسلت طلب
                DB::raw("IF(users.id IN ($sentRequestsIdsString), 1, 0) as sent_a_request"),
                //  لديك طلب
                DB::raw("IF(users.id IN ( $FriendRequestsIdsString) , 1, 0) as have_request"),
            ])
            ->first();


        return view('userAuth.view_profile', compact('user'));
    }

}
