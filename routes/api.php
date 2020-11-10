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
