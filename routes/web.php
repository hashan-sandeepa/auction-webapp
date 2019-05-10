<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@getHomePage')->name('home');

Route::get('/help', 'CommonController@getHelpPage');

Route::get('/about', 'CommonController@getAboutPage');

Route::get('/user/login', 'UserController@getLoginPage')->name('user.login.page');

Route::post('/user/login', 'UserController@login')->name('user.login');

Route::get('/user/register', 'UserController@getRegistrationPage')->name('user.registration');

Route::post('/user/register', array('uses' => 'UserController@registerUser'));

Route::get('/user/verify/{code}', 'UserController@verifyUser');

Route::get('/user/forgot-password', 'UserController@getForgotPassPage')->name('user.forgot.password');

Route::post('/user/forgot-password', 'UserController@forgotPassword');

Route::get('/user/reset-password/{token}', 'UserController@getResetPasswordPage');

Route::post('/user/reset-password', 'UserController@resetPassword');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/user/logout', 'UserController@logout');
    Route::get('/user/my/profile', 'UserController@getProfilePage')->name('user.profile.page');
    Route::post('/user/my/profile', 'UserController@editProfile');
    Route::get('/auction/my/auctions', 'AuctionController@getMyAuctionPage');
    Route::get('/auction/call', 'AuctionController@getCallAuctionPage');
    Route::post('/auction/call', 'AuctionController@callAuction');
    Route::get('/auction/bid/my/bids', 'BidController@getMyBidPage');
    Route::get('/auction/{id}/bid/history', 'BidController@getBidHistory');
});

Route::post('/auction/bid', 'BidController@placeBid');
Route::get('/auction/{id}', 'AuctionController@getAuctionInfo');
Route::post('/auction/bid/latest', 'BidController@getLatestBid');

Route::get('/user/my/profile/image', 'UserController@getProfileImage');
Route::get('/category/categories', 'CategoryController@getAllCategories');
Route::get('/auction/image/{path}', 'AuctionController@getImage');