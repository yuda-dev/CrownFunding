<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserRegistered;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class RegenerateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'email' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        $user->generate_code_otp();

        event(new UserRegistered($user, 'regenerate'));

        $data['user'] = $user;

        return response()->json([
            'response_code' => '00',
            'response_message' => 'otp berhasil di generate, silahkan cek email untuk melihat code otp',
            'data' => $data
        ]);
    }
}
