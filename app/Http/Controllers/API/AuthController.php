<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserExternal;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $isEmail = filter_var($request->email, FILTER_VALIDATE_EMAIL);
        if ($isEmail) {
            $user = User::where('email', $request->email)->first();
            if ($user) {
                if (Auth::attempt(['email' => $user->email, 'password' => $request->password])) {

                    return response()->json([
                        'status' => true,
                        'message' => 'Login successful',
                        'user' => $user,
                        'details' => $user->userDetail,


                    ]);
                }
            } else {
                $user = UserExternal::where('email', $request->email)->first();
                if ($user) {
                    if (Auth::guard('external')->attempt(['email' => $user->email, 'password' => $request->password])) {

                        return response()->json([
                            'status' => true,
                            'message' => 'Login successful',
                            'user' => $user,
                            'details' => $user->userDetail,
                        ]);
                    } else {
                        return response()->json([
                            'status' => false,
                            'message' => 'Email / Password salah'
                        ], 401);
                    }
                }
            }
        } else {
            $profile = UserProfile::where('no_pegawai', $request->email)->with('user')->first();
            if ($profile) {
                if (Auth::attempt(['email' => $profile->user->email, 'password' => $request->password])) {

                    return response()->json([
                        'status' => true,
                        'message' => 'Login successful',
                        'user' => $profile->user,
                        'details' => $profile->user->userDetail,
                    ]);
                }
            } else {
                $user = UserExternal::where('nik', $request->email)->first();
                if ($user) {
                    if (Auth::guard('external')->attempt(['email' => $user->email, 'password' => $request->password])) {

                        return response()->json([
                            'status' => true,
                            'message' => 'Login successful',
                            'user' => $user,
                            'details' => $user->userDetail,

                        ]);
                    } else {
                        return response()->json([
                            'status' => false,
                            'message' => 'Email / Password salah'
                        ], 401);
                    }
                }
            }
        }
        return response()->json([
            'status' => false,
            'message' => 'Email / Password salah'
        ], 401);
    }



    public function me(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            return response()->json([
                'status' => true,
                'data' => $user
            ]);
        }
        return response()->json(['status' => false, 'message' => 'Unauthorized'], 401);
    }
}
