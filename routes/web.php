<?php

use App\Http\Controllers\FriendController;
use App\Http\Controllers\FriendRequestController;
use App\Http\Controllers\UserController;
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
    'controller' => UserController::class,
    'middleware' => 'guest'
], function () {
    Route::get('/',  'index')->name('login');
    Route::post('user/login',  'login')->name('user.login');
    Route::get('/register',  'create')->name('register');
    Route::post('user/register',  'store')->name('user.register');
    Route::get('/reset/password',  'resetPassword')->name('reset_password');
    Route::post('/send/code',  'sendCode')->name('send_code');
    Route::get('/change/password/{email}',  'editPassword')->name('edit_password');
    Route::post('/change/password',  'changePassword')->name('change_password');
});

// route of auth users
Route::group([
    'prefix' => 'user',
    'as' => 'user.',
    'middleware' => 'auth',
], function () {
    Route::get('/logout',  [UserController::class, 'logout'])->name('logout');
    Route::get('/edit-profile', [UserController::class, 'editProfile'])->name('edit_profile');
    Route::post('/update-profile', [UserController::class, 'updateProfile'])->name('update_profile');
    Route::get('/view-profile/{id}', [UserController::class, 'viewUserProfile'])->name('view_profile');
    Route::get('/home', [UserController::class, 'home'])->name('home');
    //friend routes
    Route::get('/friends', [FriendController::class, 'index'])->name('friends');
    Route::get('/remove-friend/{id}', [FriendController::class, 'removeFriend'])->name('remove_friend');
    //friend requests route
    Route::get('/send-request/{id}', [FriendRequestController::class, 'sendFriendRequest'])->name('send_request');
    Route::get('/accept-request/{id}', [FriendRequestController::class, 'acceptFriendRequest'])->name('accept_request');
    Route::get('/decline-request/{id}', [FriendRequestController::class, 'declineFriendRequest'])->name('decline_request');
    Route::get('/cancel-request/{id}', [FriendRequestController::class, 'cancelFriendRequest'])->name('cancel_request');
});
