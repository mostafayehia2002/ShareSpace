<?php

namespace App\Http\Controllers;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FriendRequestController extends Controller
{
    //

    public  function __construct()
    {

        $this->middleware('auth');
    }

    public function sendFriendRequest($id): \Illuminate\Http\RedirectResponse
    {
        try {
            DB::table('friend_requests')->insert(
                [
                    'sender_id' => auth()->id(),
                    'receiver_id' => $id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
            toastr()->success('Successfully Send Friend Request');
        } catch (\Exception $e) {
            Log::error('Error Sending Friend Request: ' . $e->getMessage());
            // toastr()->error('Failed To Send Friend Request');
            toastr()->error($e->getMessage());
        }

        return redirect()->back();
    }


    public function acceptFriendRequest($id): \Illuminate\Http\RedirectResponse
    {
        try {
            $user = auth()->user();
            DB::table('friend_requests')
                ->where('sender_id', $id)
                ->update([
                    'status' => 'accepted',
                    'updated_at' => now(),
                ]);
            $user->friends()->attach($id);
           toastr()->success('Successfully Accept Friend Request');
        } catch (Exception $e) {
            Log::error('Error Accepting Friend Request: ' . $e->getMessage());
           toastr()->error($e->getMessage());


        }

        return redirect()->back();
    }

    //if you dont accept friend request of any user
    public function declineFriendRequest($id): \Illuminate\Http\RedirectResponse
    {
        try {
            DB::table('friend_requests')
                ->where('sender_id', $id)
                ->update([
                    'status' => 'declined',
                    'updated_at' => now(),
                ]);
            toastr()->success('Successfully Declined Friend Request');
        } catch (Exception $e) {
            Log::error('Error Declining Friend Request: ' . $e->getMessage());
            toastr()->error($e->getMessage());
        }
        return redirect()->back();
    }

    //if you send friend request to user and want to delete friend request
    public function cancelFriendRequest($receiver_id): \Illuminate\Http\RedirectResponse
    {
        try {
            $id = auth()->id();
            DB::table('friend_requests')
                ->where('sender_id',  $id)->where('receiver_id', $receiver_id)
                ->delete();
            toastr()->success('Successfully Cancel Friend Request');
        } catch (Exception $e) {
            Log::error('Error Canceling Friend Request: ' . $e->getMessage());
            toastr()->error($e->getMessage());
        }
        return redirect()->back();
    }
}
