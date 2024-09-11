<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Mail\ResetPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\SendCodeRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\ChangePasswordRequest;

class UserController extends Controller
{
    public function index()
    {
        return  view("authention.login");
    }
    public function login(LoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);
        $remember = $request->has('remember');
        if (Auth::attempt($credentials,   $remember)) {
            toastr()->success('Successfully Login');
            return  redirect()->route('user.home');
        }
        toastr()->error('Faild To Login');
        return redirect()->back()->withInput($request->only('email', 'password', 'remember'));;
    }

    public function create()
    {

        return view('authention.register');
    }


    //register new user
    public function store(RegisterRequest $request)
    {
        try {

            $credentials = $request->only(['email', 'password']);
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $file_path = $file->store('uploads', 'media');
                $photo = [
                    'file_name' => basename($file_path),
                    'file_path' => $file_path,
                    'file_size' => round($file->getSize() / (1024 * 1024), 2),
                    'file_type' => $file->getMimeType(),
                ];
                //save image info in database
                $user->media()->create($photo);
            }
            if ($user) {
                Auth::guard('web')->attempt($credentials);
                toastr()->success('Successfully Registered');
                return  redirect()->route('user.home');
            }
        } catch (\Exception $e) {
            Log::error('Error  Registering: ' . $e->getMessage());
            toastr()->error('faild to Registerd data');
        }

        toastr()->error('Faild To Registerd');
        return redirect()->back()->withInput($request->only('name', 'email', 'password'));
    }
    public function home()
    {
        return view('home');
    }
    public function logout()
    {
        Auth::guard('web')->logout();
        toastr()->success('Successfully Logout');
        return redirect()->route('login');
    }

    public function editProfile()
    {
        return view('authention.edit_profile');
    }

    public function updateProfile(UpdateProfileRequest $request)
    {

        $user = User::find(Auth::id());
        $data = $request->all();
        try {
            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            } else {
                unset($data['password']);
            }
            $user->update($data);
            //update image
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
            toastr()->success('Successfully Update Profile');
        } catch (\Exception $e) {
            Log::error('Error updating profile: ' . $e->getMessage());
            toastr()->error('faild to update data');
        }
        return redirect()->back()->withInput($request->only('name', 'email'));
    }

    public function resetPassword()
    {

        return view('authention.reset_password');
    }

    public function sendCode(SendCodeRequest $request)
    {

        try {
            $email = $request->email;
            //make random degit
            $code = rand(1111, 9999);
            //get user
            $user = User::where('email', $email)->first();
            //save code to database
            $user->update(['code' => $code]);
            //send code to mail
            $url = request()->getSchemeAndHttpHost() . "/change/password/$email";
            Mail::to($email)->send(new ResetPassword($code, $url, $user->name));

            toastr()->success('successfully Send Code To Mail');
        } catch (\Exception $e) {
            Log::error('Error sending code: ' . $e->getMessage());
            toastr()->error('Failed to send code');
        }

        return  redirect()->route('edit_password', $email);
    }

    public function editPassword($email)
    {

        return view('authention.change_password', compact('email'));
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $user = User::where('email', $request->email)
            ->where('code', $request->code)
            ->first();
        if ($user) {
            $user->update([
                'password' => Hash::make($request->password),
                'code' => null,
            ]);
            toastr()->success('Password changed successfully.');
            return redirect()->route('login');
        }
        toastr()->error('Invalid code or email. Please try again.');
        return redirect()->back()->withInput($request->only('email', 'code'));
    }


    public function viewUserProfile($id)
    {
        $user=auth()->user();
        $friendsIdsArray = $user->getFriends();

        $friendsIdsString = !empty($friendsIdsArray) ? implode(',', $friendsIdsArray) : '0';
        $sentRequestsIds = $user->sentFriendRequests->where('status', 'pending')->pluck('receiver_id')->toArray();
        $sentRequestsIdsString = !empty($sentRequestsIds) ? implode(',', $sentRequestsIds) : '0';
        $FriendRequestsIds = $user->receivedFriendRequests->where('status', 'pending')->pluck('sender_id')->toArray();
        $FriendRequestsIdsString = !empty($FriendRequestsIds) ? implode(',', $FriendRequestsIds) : '0';
        // Get all sent friend requests' IDs as a comma-separated string
        $user = DB::table('users')
            ->leftJoin('media', function ($join) {
                $join->on('users.id', '=', 'media.mediable_id')
                    ->where('media.mediable_type', '=', 'App\\Models\\User');
            })
            ->where('users.id', $id)
            ->select('users.*', 'media.file_path')->addSelect([
                //هل هم اصدقاء
                DB::raw("IF(users.id IN ( $friendsIdsString) , 1, 0) as is_friends"),
                // ارسلت طلب
                DB::raw("IF(users.id IN ($sentRequestsIdsString), 1, 0) as sent_a_request"),
                //  لديك طلب
                DB::raw("IF(users.id IN ( $FriendRequestsIdsString) , 1, 0) as have_request"),
                    ])
            ->first();


            return view('authention.view_profile', compact('user'));
    }
}
