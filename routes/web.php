<?php

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

Route::get('/', function () {
    return redirect('login');
});
Route::get('/login', 'Auth\UserAuthController@loadLogin')->name('login');
Route::post('/login', 'Auth\UserAuthController@login')->name('auth.login');

Route::get('/register', 'Auth\UserAuthController@loadRegister')->name('register');
Route::post('/register', 'Auth\UserAuthController@register')->name('auth.register');

Route::get('/forgot-password', 'Auth\UserAuthController@forgotPassword');
Route::get('/verify-account', 'Auth\UserAuthController@verifyAccount')->name('verify.account');

Route::post('/reset-password-request', 'Auth\UserAuthController@resetPasswordRequest')->name('reset.password.request');
Route::get('/reset-password/{email}', 'Auth\UserAuthController@resetPassword')->name('reset.password');
Route::post('/password-update', 'Auth\UserAuthController@passwordUpdate')->name('password.update');

Route::post('/verification-send', 'Auth\UserAuthController@verificationSend')->name('verification.send');

Route::middleware(['auth'])->group(function () {
    Route::resource('/campaigns', 'CampaignController');
    Route::resource('/attendees', 'CampaignAttendeesController');
    Route::post('/send-invite', 'CampaignAttendeesController@sendInvite')->name('attendees.sendInvite');
    Route::get('/invite', 'CampaignAttendeesController@invite');
    Route::get('/logout', 'Auth\UserAuthController@logout');
});