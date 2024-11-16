<?php

use App\Http\Controllers\Auth\UserChangePasswordController;
use App\Http\Controllers\Auth\UserLoginController;
use App\Http\Controllers\Auth\UserLogoutController;
use App\Http\Controllers\Auth\UserProfileController;
use App\Http\Controllers\Auth\UserRegisterController;
use App\Http\Controllers\Auth\UserResetPasswordController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\FriendRequestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserHomeController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//route of guest users
Route::group([
    'middleware' => 'guest'
], function () {
    Route::get('/',  [UserLoginController::class,'index'])->name('login');
    Route::post('user/login',  [UserLoginController::class,'login'])->name('user.login');
    Route::get('/register',  [UserRegisterController::class,'index'])->name('register');
    Route::post('user/register',  [UserRegisterController::class,'register'])->name('user.register');
    Route::get('/reset-password',  [UserResetPasswordController::class,'index'])->name('reset_password');
    Route::post('/user/reset-password',  [UserResetPasswordController::class,'resetPassword'])->name('user.reset_password');
    Route::get('/edit-password/{email}', [UserChangePasswordController::class,'index'])->name('edit_password');
    Route::post('/change-password',  [UserChangePasswordController::class,'changePassword'])->name('change_password');
});
// route of auth users
Route::group([
    'prefix' => 'user',
    'as' => 'user.',
    'middleware' => ['auth','last_active_at'],
], function (){
    Route::get('/home', [UserHomeController::class, 'home'])->name('home');
    Route::get('/logout',  [UserLogoutController::class, 'logout'])->name('logout');
    Route::get('/edit-profile', [UserProfileController::class, 'editProfile'])->name('edit_profile');
    Route::post('/update-profile', [UserProfileController::class, 'updateProfile'])->name('update_profile');
    Route::get('/view-profile/{id}', [UserProfileController::class, 'viewUserProfile'])->name('view_profile');
    //friend routes
    Route::get('/friends', [FriendController::class, 'getUsersWithFriendStatus'])->name('friends');
    Route::get('/remove-friend', [FriendController::class, 'removeFriend'])->name('remove_friend');
    //friend requests route
    Route::get('/send-request', [FriendRequestController::class, 'sendFriendRequest'])->name('send_request');
    Route::get('/accept-request', [FriendRequestController::class, 'acceptFriendRequest'])->name('accept_request');
    Route::get('/decline-request', [FriendRequestController::class, 'declineFriendRequest'])->name('decline_request');
    Route::get('/cancel-request', [FriendRequestController::class, 'cancelFriendRequest'])->name('cancel_request');
});
