<?php

namespace App\Services;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRegisterService
{
    protected TokenService $tokenService;
    public function __construct(TokenService $tokenService)
    {
        $this->tokenService = $tokenService;
    }

    public function register(RegisterRequest $request): array
    {
            $credentials = $request->only(['email', 'password']);
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password'))
            ]);
             $this->uploadProfilePhoto($request,$user);
            if ($user) {
                Auth::guard('web')->attempt($credentials);
              $user->token= $this->tokenService->createApiToken($request,$user);
                return[
                    'success' => true,
                    'message' =>__('messages.success_register'),
                    'user' => $user,
                ];
            }
            return [
                'success' => false,
                'message' =>__('messages.failure_register'),
            ];
    }
    public function uploadProfilePhoto(RegisterRequest $request,$user)
    {
        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $file_path = $file->store('uploads', 'media');
            $photo = [
                'file_name' => basename($file_path),
                'file_path' => $file_path,
                'file_size' => round($file->getSize() / (1024 * 1024), 2),
                'file_type' => $file->getMimeType(),
            ];
            //save image info in database
          return  $user->media()->create($photo);

        }
        return  false;
    }

}
