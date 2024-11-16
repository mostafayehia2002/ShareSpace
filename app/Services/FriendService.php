<?php

namespace App\Services;

use App\Http\Requests\FriendRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class FriendService
{
    public function getUsersWithFriendStatus()
    {
        $currentUser = auth()->user();
        $friendsIdsArray = $currentUser->getFriends();
        $friendsIdsString = !empty($friendsIdsArray) ? implode(',', $friendsIdsArray) : '0';
// Get all received friend requests' IDs as a comma-separated string
        $friendRequestsIds = $currentUser->receivedFriendRequests()->pluck('sender_id')->toArray();
        $friendRequestsIdsString = !empty($friendRequestsIds) ? implode(',', $friendRequestsIds) : '0';
// Get all sent friend requests' IDs as a comma-separated string
        $sentRequestsIds = $currentUser->sentFriendRequests()->pluck('receiver_id')->toArray();
        $sentRequestsIdsString = !empty($sentRequestsIds) ? implode(',', $sentRequestsIds) : '0';

// Fetch users with additional information about friendship, received and sent friend request status
        return User::where('users.id', '!=', $currentUser->id)
            ->with('media')
            ->select('users.*')
            ->addSelect([
// هل هم أصدقاء
                DB::raw("IF(users.id IN ($friendsIdsString), 1, 0) as is_friends"),
// لديك طلب
                DB::raw("IF(users.id IN ($friendRequestsIdsString), 1, 0) as have_request"),
                // أرسلت طلب
                DB::raw("IF(users.id IN ($sentRequestsIdsString), 1, 0) as sent_a_request"),
            ])
            ->orderBy('have_request', 'desc')
            ->Paginate(15);

    }
    public function removeFriend(FriendRequest $request): array
    {
        $friend_id=$request->input('id');
        $remove = DB::table('friends')->where('user_id', $friend_id)->orWhere('friend_id', $friend_id)->delete();
        if ($remove) {
            return [
                'success' => true,
                'message' => __('messages.success_remove_friend'),
            ];
        }
        return [
            'success' => false,
            'message' => __('messages.failure_remove_friend')
        ];
    }
}
