<?php

use App\Http\Controllers\Api\FriendController;
use App\Http\Controllers\Api\FriendRequestController;
use App\Http\Controllers\Api\UserChangePasswordController;
use App\Http\Controllers\Api\UserLoginController;
use App\Http\Controllers\Api\UserLogoutController;
use App\Http\Controllers\Api\UserProfileController;
use App\Http\Controllers\Api\UserRegisterController;
use App\Http\Controllers\Api\UserResetPasswordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::fallback(function (){
    return response()->json(['error'=>"route not found"]);
});
Route::group([
    'prefix'=>'user',
    'middleware'=>['api_lang','last_active_at']
],function (){
    Route::post('/login',[UserLoginController::class,'login']);
    Route::post('/register',[UserRegisterController::class,'register']);
    Route::post('/reset-password',[UserResetPasswordController::class,'resetPassword']);
    Route::post('/change-password',[UserChangePasswordController::class,'changePassword']);
    Route::group([
        'middleware'=>['auth:sanctum']
    ],function (){
        Route::post('/logout',[UserLogoutController::class,'logout']);
        Route::get('/edit-profile',[UserProfileController::class,'editProfile']);
        Route::post('/update-profile',[UserProfileController::class,'updateProfile']);
       // Route::get('/view-profile/{id}', [UserProfileController::class, 'viewUserProfile']);

        //
        Route::get('/friends', [FriendController::class, 'getUsersWithFriendStatus']);
        Route::delete('/remove-friend', [FriendController::class, 'removeFriend']);
        //
        Route::post('/send-request', [FriendRequestController::class, 'sendFriendRequest']);
        Route::post('/accept-request', [FriendRequestController::class, 'acceptFriendRequest']);
        Route::post('/decline-request', [FriendRequestController::class, 'declineFriendRequest']);
        Route::delete('/cancel-request', [FriendRequestController::class, 'cancelFriendRequest']);

    });


});

