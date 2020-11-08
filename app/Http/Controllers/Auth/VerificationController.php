<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Otp;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class VerificationController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $otp_code = Otp::where('otp', $request->otp)->first();

        if (!$otp_code) {
            return response()->json([
                'response_code' => '01',
                'message' => 'OPT Code tidak ditemukan !'
            ], 200);
        }

        $now = Carbon::now();

        if ($now > $otp_code->valid_until) {
            return response()->json([
                'response_code' => '01',
                'message' => 'kode otp sudah tidak berlaku, silahkan generete kembali',
            ], 200);
        }

        $user = User::find($otp_code->user_id);
        $user->email_verified_at = Carbon::now();
        $user->save();

        $otp_code->delete();
        $data['user'] = $user;

        return response()->json([
            'message' => 'OTP Code sudah berhasil di verifikasi',
        ]);
    }
}
