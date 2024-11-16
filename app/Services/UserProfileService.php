<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class UserProfileService
{

    //get personal user data
    public function editProfile():array
    {
      $user_id=auth()->id();
        $user =DB::table('users')
            ->leftJoin('media', function ($join) {
                $join->on('users.id', '=', 'media.mediable_id')
                    ->where('media.mediable_type', '=', 'App\\Models\\User');
            })->where('users.id', $user_id)
            ->select('users.*', 'media.file_path')->first();
        if($user){
            return [
                'success' => true,
                'message'=>trans('messages.success_get_profile'),
                'user' => $user,
            ];
        }
        return [
            'success' => true,
            'message' =>trans('messages.failure_get_profile'),
        ];
    }
}
