<?php

Route::get('user', 'UserController');

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth',
    'namespace' => 'Auth'
], function () {
    Route::post('register', 'RegisterController');
    Route::post('login', 'LoginController');
    Route::post('logout', 'LogoutController')->middleware('auth:api');
    Route::post('verification', 'VerificationController');
    Route::post('regenerate-otp', 'RegenerateController');
    Route::post('update-password', 'UpdatePasswordController');
});

Route::group([
    'middleware' => ['api', 'email_verified', 'auth:api'],
], function () {

    Route::get('profile/show', 'ProfileController@show');
    Route::post('profile/update', 'ProfileController@update');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'campaign',
], function () {
    Route::get('random/{count}', 'CampaignController@random');
    Route::post('store', 'CampaignController@store');
    Route::get('/', 'CampaignController@index');
    Route::get('/{id}', 'CampaignController@detail');
    Route::get('/search/{keyword}', 'CampaignController@search');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'blog',
], function () {
    Route::get('random/{count}', 'BlogController@random');
    Route::post('store', 'BlogController@store');
});
