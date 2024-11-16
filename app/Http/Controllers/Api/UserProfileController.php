<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Resources\ProfileInfoResource;
use App\Services\UserProfileService;
use App\Services\UserUpdateProfileService;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserProfileController extends Controller
{
    use HttpResponse;

public UserProfileService $profileUserService;
public UserUpdateProfileService $updateProfileService;
public function __construct(UserProfileService $profileUserService,UserUpdateProfileService $updateProfileService)
{
    $this->profileUserService=$profileUserService;
    $this->updateProfileService=$updateProfileService;
}
 //get personal user data
public function editProfile(): \Illuminate\Http\JsonResponse
{
    try {
        $response=$this->profileUserService->editProfile();
        if($response['success']){
            return $this->returnData(200,$response['message'],'data',new ProfileInfoResource($response['user']));
        }
        return $this->returnErrorMessage(404,$response['message']);
    }catch (\Exception $e){
        Log::error('Error loading profile info: ' . $e->getMessage());
        return  $this->returnErrorMessage(error:$e->getMessage());
    }
}


public function updateProfile(UpdateProfileRequest $request)
{

    try {
        $response= $this->updateProfileService->updateProfile($request);
        if($response['success']) {

           return  $this->returnSuccessMessage(message:$response['message']);
        }

        return $this->returnErrorMessage(422,error:$response['message']);

    } catch (\Exception $e) {

        Log::error('Error updating profile: ' . $e->getMessage());
    }

}
}
