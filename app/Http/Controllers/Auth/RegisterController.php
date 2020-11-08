<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Otp;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //validate data
        $validator = Validator::make(
            $request->all(),
            [
                'name'     => ['string', 'required'],
                'email'   => ['email', 'required', 'unique:users,email']
            ],
            [
                'name.required' => 'Enter your name !',
                'email.required' => 'Enter Your Email !',
            ]
        );

        if ($validator->fails()) {

            return response()->json([
                'message' => 'The given data was invalid !',
                'errors'    => $validator->errors()
            ], 400);
        } else {

            $data = new User();
            $data->name = $request->name;
            $data->email = $request->email;
            $data->save();

            $minutes = 3000;
            $code_otp = new Otp();
            $code_otp->otp = rand(111111, 999999);
            $code_otp->user_id = $data->id;
            $code_otp->valid_until = \Carbon\Carbon::now()->addMinutes($minutes);
            $code_otp->save();

            if ($data) {
                return response()->json([
                    'response_code' => '00',
                    'message' => 'Silahkan cek email!',
                    'data' => [
                        'users' => [
                            'name' => $data->name,
                            'email' => $data->email,
                            'created_at' => $data->created_at,
                            'updated_at' => $data->updated_at,
                            'id' => $data->id,
                        ]

                    ]
                ], 200);
            } else {
                return response()->json([
                    'response_code' => false,
                    'message' => 'Gagal Disimpan!',
                ], 400);
            }
        }
    }
}
