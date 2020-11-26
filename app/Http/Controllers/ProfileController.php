<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function show()
    {
        $data['user'] = auth()->user();

        return response()->json([
            'response_code' => '00',
            'response_message' => 'Profile berhasil ditampilkan',
            'data' => $data
        ], 200);
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        if ($request->hasFile('photo_profile')) {
            $image = $request->file('photo_profile');
            $image_name = \Carbon\Carbon::now() . '-' . $image->getClientOriginalName();
            $image_folder = '/photos/users/photo-profile/';
            $image_location = $image_folder . $image_name;

            try {
                $image->move(public_path($image_folder), $image_name);

                $user->update([
                    'photo_profile' => $image_location
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'response_code' => '01',
                    'response_message' => 'gagal',
                    'data' => $data
                ], 200);
            }
        }

        $user->update([
            'name' => $request->name,
        ]);

        $data['user'] = $user;

        return response()->json([
            'response_code' => '00',
            'response_message' => 'berhasil di update',
            'data' => $data
        ], 200);
    }
}
