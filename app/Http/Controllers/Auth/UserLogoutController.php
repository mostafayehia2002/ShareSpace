<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\UserLogoutService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserLogoutController extends Controller
{

    public UserLogoutService $logoutService;

    public function __construct(UserLogoutService $logoutService)
    {
        $this->logoutService = $logoutService;
    }

    /**
     * @return RedirectResponse|void
     */
    public function logout(Request $request)
    {
        try {
            $response=$this->logoutService->logout($request);
            if($response['success']){
                toastr()->success($response['message']);
                return redirect()->route('login');
            }
            toastr()->error($response['message']);
            return redirect()->back();
        }catch (\Exception $e){
            Log::error('Error  Logout: ' . $e->getMessage());
            toastr()->error($e->getMessage());
        }
    }
}
