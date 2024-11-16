<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\UserLoginService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class UserLoginController extends Controller
{
    public UserLoginService $loginService;

    public function __construct(UserLoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function index()
    {
        return view("userAuth.login");
    }

    public function login(LoginRequest $request): \Illuminate\Http\RedirectResponse
    {
        $response=$this->loginService->login($request);
        if ($response['success']) {

            toastr()->success($response['message']);
            return redirect()->route('user.home');
        }
        toastr()->error($response['message']);

        return redirect()->back()->withInput($request->only('email', 'password', 'remember'));
    }

}
