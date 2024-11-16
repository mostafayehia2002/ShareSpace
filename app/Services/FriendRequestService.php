<?php

namespace App\Services;

use App\Enums\FriendRequestStatus;
use App\Http\Requests\FriendRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class FriendRequestService
{
    public function sendFriendRequest(FriendRequest $request): array
    {
        $receiverId=$request->input('id');
        $user = auth()->user();
        $send_request = $user->sentFriendRequests()->create(['receiver_id' => $receiverId]);
        if ($send_request) {
            return [
                'success' => true,
                'message' => __('messages.success_send_request')
            ];
        }
        return [
            'success' => false,
            'message' => __('messages.failure_send_request')
        ];

    }

    public function acceptFriendRequest(FriendRequest $request): array
    {
        $senderId=$request->input('id');
        $user = auth()->user();
        $accept_request = DB::table('friend_requests')
            ->where('sender_id', $senderId)
            ->update([
                'status' => FriendRequestStatus::ACCEPTED,
                'updated_at' => now(),
            ]);
        $user->friends()->attach($senderId);
        if ($accept_request) {
            return [
                'success' => true,
                'message' => __('messages.success_accept_request')
            ];
        }
        return [
            'success' => false,
            'message' => __('messages.failure_accept_request')
        ];
    }

    public function declineFriendRequest(FriendRequest $request): array
    {
        $senderId=$request->input('id');
        $declined_request = DB::table('friend_requests')
            ->where('sender_id', $senderId)
            ->update([
                'status' => FriendRequestStatus::DECLINED,
                'updated_at' => now(),
            ]);
        if ($declined_request) {
            return [
                'success' => true,
                'message' => __('messages.success_declined_request')
            ];
        }
        return [
            'success' => false,
            'message' => __('messages.failure_declined_request')
        ];
    }

    public function cancelFriendRequest(FriendRequest $request): array
    {
        $receiverId=$request->input('id');
        $senderId = auth()->id();
        $canceled_request = DB::table('friend_requests')
            ->where('sender_id', $senderId)
            ->where('receiver_id', $receiverId)
            ->delete();
        if ($canceled_request) {
            return [
                'success' => true,
                'message' => __('messages.success_canceled_request')
            ];
        }
        return [
            'success' => false,
            'message' => __('messages.failure_canceled_request')
        ];

    }
}
