<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FriendController extends Controller
{


    public function index()
    {
        $user = auth()->user();
        $friendsIdsArray = $user->getFriends();
        $friendsIdsString = !empty($friendsIdsArray) ? implode(',', $friendsIdsArray) : '0';
        // Get all received friend requests' IDs as a comma-separated string
        $FriendRequestsIds = $user->receivedFriendRequests->where('status', 'pending')->pluck('sender_id')->toArray();
        $FriendRequestsIdsString = !empty($FriendRequestsIds) ? implode(',', $FriendRequestsIds) : '0';
        // Get all sent friend requests' IDs as a comma-separated string

        $sentRequestsIds = $user->sentFriendRequests->where('status', 'pending')->pluck('receiver_id')->toArray();
        $sentRequestsIdsString = !empty($sentRequestsIds) ? implode(',', $sentRequestsIds) : '0';
        // Fetch users with additional information about friendship, received and sent friend request status
        $users = DB::table('users')
            ->where('users.id', '!=', $user->id)
            ->leftJoin('media', function ($join) {
                $join->on('users.id', '=', 'media.mediable_id')
                    ->where('media.mediable_type', '=', 'App\\Models\\User');
            })
            ->select('users.*', 'media.file_path')
            ->addSelect([
                //هل هم اصدقاء
                DB::raw("IF(users.id IN ( $friendsIdsString) , 1, 0) as is_friends"),
                //  لديك طلب
                DB::raw("IF(users.id IN ( $FriendRequestsIdsString) , 1, 0) as have_request"),
                // ارسلت طلب
                DB::raw("IF(users.id IN ($sentRequestsIdsString), 1, 0) as sent_a_request"),
            ])->orderBy('have_request','desc')->simplePaginate(15);


       return view('pages.friends', compact('users'));
    }


    public function removeFriend($id)
    {
        try {
            DB::table('friends')->where('user_id',$id)->orWhere('friend_id',$id)->delete();
            toastr()->success('Successfully Removed Friend');
        } catch (Exception $e) {
            Log::error('Error Removeing Friend : ' . $e->getMessage());
            toastr()->error($e->getMessage());
        }

        return redirect()->back();
    }


}
