<?php

namespace App\Services;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserUpdateProfileService
{

    public function updateProfile(UpdateProfileRequest $request): array
    {
        $user = User::find(Auth::id());
        $data = $request->validated();
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->input('password'));
        } else {
            unset($data['password']);
        }
       $user_updated= $user->update($data);
        $this->updatePhoto($request,$user);
        if($user_updated){
            return [
                'success' => true,
                'message'=>trans('messages.success_update_profile'),
            ];
        }
        return [
            'success' => true,
            'message' =>trans('messages.failure_update_profile'),
        ];

    }

    protected function updatePhoto(UpdateProfileRequest $request,$user): void
    {
        if ($request->hasFile('photo')) {
            //store new photo
            $file = $request->file('photo');
            $file_path = $file->store('uploads', 'media');
            $photo = [
                'file_name' => basename($file_path),
                'file_path' => $file_path,
                'file_size' => round($file->getSize() / (1024 * 1024), 2),
                'file_type' => $file->getMimeType(),
            ];
            if ($user->media) {
                //delete old photo
                Storage::disk('media')->delete($user->media->file_path);
                //update info of photo in database
                $user->media->update($photo);
            } else {

                $user->media()->create($photo);
            }
        }
    }
}
