<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Services\UserRegisterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserRegisterController extends Controller
{
    protected UserRegisterService $registerUserService;

    public function __construct(UserRegisterService $registerUserService)
    {
        $this->registerUserService=$registerUserService;
    }
    public function index()
    {

        return view('userAuth.register');
    }


    //register new user
    public function register(RegisterRequest $request)
    {
        try {
            $response=  $this->registerUserService->register($request);
            if ($response['success']){
                toastr()->success($response['message']);
                return  redirect()->route('user.home');
            }
            toastr()->error($response['message']);
            return redirect()->back()->withInput($request->only('name', 'email', 'password'));
        } catch (\Exception $e) {
            Log::error('Error  Registering: ' . $e->getMessage());
            toastr()->error($e->getMessage());
        }
    }

}
