<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.login');
    }

    public function login(Request $request)
    {
        $isEmail = filter_var($request->email, FILTER_VALIDATE_EMAIL);
        if ($isEmail) {
            $user = User::where('email', $request->email)->first();
            if ($user) {
                $this->mappingUser($user);
                if (Auth::attempt(['email' => $user->email, 'password' => $request->password])) {
                    return redirect()->route('dashboard');
                }
            }
        } else {
            $profile = UserProfile::where('no_pegawai', $request->email)->with('user')->first();
            if ($profile) {
                $this->mappingUser($profile->user);
                if (Auth::attempt(['email' => $profile->user->email, 'password' => $request->password])) {
                    return redirect()->route('dashboard');
                }
            }
        }
        return redirect()->back()->with('error', 'Email / Password salah');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    private function mappingUser($user)
    {
        // SUPER ADMIN
        if ($user->internal_role_id == 1 || $user->internal_role_id == 2) {
            UserDetail::updateOrCreate(
                ['user_id' => $user->id],
                ['role' => 1, 'is_active' => 1, 'uptd_id' => 0]
            );
        }
        // KEPADA UPTD 1
        if ($user->internal_role_id == 23 || $user->internal_role_id == 24) {
            UserDetail::updateOrCreate(
                ['user_id' => $user->id],
                ['role' => 6, 'is_active' => 1, 'uptd_id' => 1]
            );
        }
        // KEPADA UPTD 2
        if ($user->internal_role_id == 27 || $user->internal_role_id == 28) {
            UserDetail::updateOrCreate(
                ['user_id' => $user->id],
                ['role' => 6, 'is_active' => 1, 'uptd_id' => 2]
            );
        }
        // KEPADA UPTD 3
        if ($user->internal_role_id == 31 || $user->internal_role_id == 32) {
            UserDetail::updateOrCreate(
                ['user_id' => $user->id],
                ['role' => 6, 'is_active' => 1, 'uptd_id' => 3]
            );
        }
        // KEPADA UPTD 4
        if ($user->internal_role_id == 35 || $user->internal_role_id == 36) {
            UserDetail::updateOrCreate(
                ['user_id' => $user->id],
                ['role' => 6, 'is_active' => 1, 'uptd_id' => 4]
            );
        }
        // KEPADA UPTD 5
        if ($user->internal_role_id == 39 || $user->internal_role_id == 40) {
            UserDetail::updateOrCreate(
                ['user_id' => $user->id],
                ['role' => 6, 'is_active' => 1, 'uptd_id' => 5]
            );
        }
        // KEPADA UPTD 6
        if ($user->internal_role_id == 43 || $user->internal_role_id == 44) {
            UserDetail::updateOrCreate(
                ['user_id' => $user->id],
                ['role' => 6, 'is_active' => 1, 'uptd_id' => 6]
            );
        }
        // ADMIN-UPTD
        if ($user->internal_role_id == 56 || $user->internal_role_id == 58 || $user->internal_role_id == 66 || $user->internal_role_id == 73 || $user->internal_role_id == 80 || $user->internal_role_id == 115) {
            if ($user->internal_role_id == 56) {
                $uptd_id = 1;
            }
            if ($user->internal_role_id == 58) {
                $uptd_id = 3;
            }
            if ($user->internal_role_id == 66) {
                $uptd_id = 4;
            }
            if ($user->internal_role_id == 73) {
                $uptd_id = 5;
            }
            if ($user->internal_role_id == 80) {
                $uptd_id = 6;
            }
            if ($user->internal_role_id == 115) {
                $uptd_id = 2;
            }
            UserDetail::updateOrCreate(
                ['user_id' => $user->id],
                ['role' => 2, 'is_active' => 1, 'uptd_id' => $uptd_id]
            );
        }
        // PPK
        if ($user->internal_role_id == 55 || $user->internal_role_id == 64 || $user->internal_role_id == 68 || $user->internal_role_id == 74 || $user->internal_role_id == 81 || $user->internal_role_id == 88) {
            if ($user->internal_role_id == 55) {
                $uptd_id = 1;
            }
            if ($user->internal_role_id == 64) {
                $uptd_id = 3;
            }
            if ($user->internal_role_id == 68) {
                $uptd_id = 4;
            }
            if ($user->internal_role_id == 74) {
                $uptd_id = 5;
            }
            if ($user->internal_role_id == 81) {
                $uptd_id = 6;
            }
            if ($user->internal_role_id == 88) {
                $uptd_id = 2;
            }
            UserDetail::updateOrCreate(
                ['user_id' => $user->id],
                ['role' => 5, 'is_active' => 1, 'uptd_id' => $uptd_id]
            );
        }
    }
}
