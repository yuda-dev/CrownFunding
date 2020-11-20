<?php

Route::get('user', 'UserController');

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth',
    'namespace' => 'Auth'
], function () {
    Route::post('register', 'RegisterController');
    Route::post('login', 'LoginController');
    Route::get('logout', 'LogoutController');
    Route::post('verification', 'VerificationController');
    Route::post('regenerate-otp', 'RegenerateController');
    Route::post('update-password', 'UpdatePasswordController');
});

Route::group([
    'middleware' => ['api', 'email_verified', 'auth:api'],
], function () {

    Route::get('profile/show', 'ProfilController@show');
    Route::post('profile/update', 'ProfileController@update');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'campaign',
], function () {
    Route::get('random/{count}', 'CampaignController@random');
    Route::post('store', 'CampaignController@store');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'blog',
], function () {
    Route::get('random/{count}', 'BlogController@random');
    Route::post('store', 'BlogController@store');
});
