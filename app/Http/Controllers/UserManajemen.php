<?php

namespace App\Http\Controllers;

use App\Models\Konsultan;
use App\Models\Kontraktor;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\UserExternal;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserManajemen extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adminUPTD = UserDetail::where('role', 2)->with('user')->get();
        $ppk = UserDetail::where('role', 5)->with('user')->get();
        $kontraktor = UserExternal::where('role', 3)->get();
        $konsultan = UserExternal::where('role', 4)->get();
        $dataKontraktor = Kontraktor::all();
        $dataKonsultan = Konsultan::all();
        return view('user.index', compact('adminUPTD', 'ppk', 'kontraktor', 'konsultan', 'dataKontraktor', 'dataKonsultan'));
    }

    public function createAdminUPTD(Request $request)
    {
        $uptd_id = 0;
        if ($request->uptd == 56) {
            $uptd_id = 1;
        }
        if ($request->uptd == 58) {
            $uptd_id = 3;
        }
        if ($request->uptd == 66) {
            $uptd_id = 4;
        }
        if ($request->uptd == 73) {
            $uptd_id = 5;
        }
        if ($request->uptd == 80) {
            $uptd_id = 6;
        }
        if ($request->uptd == 115) {
            $uptd_id = 2;
        }
        $validator = Validator::make($request->all(), [
            'email' => 'unique:temanjabar.users',
            'no_pegawai' => 'unique:temanjabar.user_pegawai',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }
        try {
            DB::beginTransaction();
            $id = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role' => 'internal',
                'password' => Hash::make($request->password),
                'email_verified_at' => date('Y-m-d H:i:s'),
                'internal_role_id' => $request->uptd,
            ])->id;

            UserProfile::create([
                'no_pegawai' => $request->no_pegawai,
                'nama' => $request->name,
                'no_tlp' => $request->no_tlp,
                'user_id' => $id,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => Auth::user()->id,
            ]);
            UserDetail::updateOrCreate(['user_id' => $id], [
                'role' => 5,
                'uptd_id' => $uptd_id,
                'is_active' => 0,
                'role' => 2,
            ]);
            DB::commit();
            return redirect()->back()->with('success', 'Berhasil menambahkan admin UPTD');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal menambahkan admin UPTD');
        }
    }

    public function updateAdminUptd(Request $request, $id)
    {
        $uptd_id = 0;
        if ($request->uptd == 56) {
            $uptd_id = 1;
        }
        if ($request->uptd == 58) {
            $uptd_id = 3;
        }
        if ($request->uptd == 66) {
            $uptd_id = 4;
        }
        if ($request->uptd == 73) {
            $uptd_id = 5;
        }
        if ($request->uptd == 80) {
            $uptd_id = 6;
        }
        if ($request->uptd == 115) {
            $uptd_id = 2;
        }
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if ($user->id != $id) {
                return redirect()->back()->with('error', 'Email sudah digunakan');
            }
        }
        $nip = UserProfile::where('no_pegawai', $request->no_pegawai)->first();
        if ($nip) {
            if ($nip->user_id != $id) {
                return redirect()->back()->with('error', 'NIP sudah digunakan');
            }
        }
        try {
            DB::beginTransaction();
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->internal_role_id = $request->uptd;
            if ($request->password != null) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            UserProfile::updateOrCreate(['user_id' => $id], [
                'no_pegawai' => $request->no_pegawai,
                'nama' => $request->name,
                'no_tlp' => $request->no_tlp
            ]);
            $userDetail = UserDetail::where('user_id', $id)->first();
            $userDetail->role = 2;
            $userDetail->uptd_id = $uptd_id;
            $userDetail->save();
            DB::commit();
            return redirect()->back()->with('success', 'Berhasil mengubah admin UPTD');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal mengubah admin UPTD');
        }
    }

    public function createUserKonsultan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'unique:user_externals',
            'nik' => 'unique:user_externals',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }
        UserExternal::create([
            'name' => $request->name,
            'email' => $request->email,
            'nik' => $request->nik,
            'password' => Hash::make($request->password),
            'no_telp' => $request->no_telp,
            'konsultan_id' => $request->konsultan_id,
            'uptd_id' => $request->uptd,
            'jabatan' => $request->jabatan,
            'is_active' => 0,
            'role' => 4,
        ]);

        return redirect()->back()->with('success', 'Berhasil menambahkan user konsultan');
    }

    public function updateUserKonsultan(Request $request, $id)
    {
        $user = UserExternal::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->nik = $request->nik;
        $user->no_telp = $request->no_telp;
        $user->konsultan_id = $request->konsultan_id;
        $user->uptd_id = $request->uptd;
        $user->jabatan = $request->jabatan;
        if ($request->password != null) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->back()->with('success', 'Berhasil mengubah user konsultan');
    }

    public function deleteUserKonsultan($id)
    {
        $user = UserExternal::find($id);
        $user->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus user konsultan');
    }

    public function createUserPPK(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'unique:temanjabar.users',
            'no_pegawai' => 'unique:temanjabar.user_pegawai',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }
        $uptd_id = 0;
        if ($request->uptd == 55) {
            $uptd_id = 1;
        }
        if ($request->uptd == 64) {
            $uptd_id = 3;
        }
        if ($request->uptd == 68) {
            $uptd_id = 4;
        }
        if ($request->uptd == 74) {
            $uptd_id = 5;
        }
        if ($request->uptd == 81) {
            $uptd_id = 6;
        }
        if ($request->uptd == 88) {
            $uptd_id = 2;
        }
        try {
            DB::beginTransaction();
            $id = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role' => 'internal',
                'password' => Hash::make($request->password),
                'email_verified_at' => date('Y-m-d H:i:s'),
                'internal_role_id' => $request->uptd,
            ])->id;

            UserProfile::create([
                'no_pegawai' => $request->no_pegawai,
                'nama' => $request->name,
                'no_tlp' => $request->no_tlp,
                'user_id' => $id,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => Auth::user()->id,
            ]);

            UserDetail::updateOrCreate(['user_id' => $id], [
                'role' => 5,
                'uptd_id' => $uptd_id,
                'is_active' => 0,
            ]);
            DB::commit();

            return redirect()->back()->with('success', 'Berhasil menambahkan user PPK');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal menambahkan user PPK');
        }
    }

    public function updateUserPPK(Request $request, $id)
    {
        $uptd_id = 0;
        if ($request->uptd == 55) {
            $uptd_id = 1;
        }
        if ($request->uptd == 64) {
            $uptd_id = 3;
        }
        if ($request->uptd == 68) {
            $uptd_id = 4;
        }
        if ($request->uptd == 74) {
            $uptd_id = 5;
        }
        if ($request->uptd == 81) {
            $uptd_id = 6;
        }
        if ($request->uptd == 88) {
            $uptd_id = 2;
        }
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if ($user->id != $id) {
                return redirect()->back()->with('error', 'Email sudah digunakan');
            }
        }
        $nip = UserProfile::where('no_pegawai', $request->no_pegawai)->first();
        if ($nip) {
            if ($nip->user_id != $id) {
                return redirect()->back()->with('error', 'NIP sudah digunakan');
            }
        }
        try {
            DB::beginTransaction();
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->internal_role_id = $request->uptd;
            if ($request->password != null) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            UserProfile::updateOrCreate(['user_id' => $id], [
                'no_pegawai' => $request->no_pegawai,
                'nama' => $request->name,
                'no_tlp' => $request->no_tlp
            ]);
            UserDetail::updateOrCreate(['user_id' => $id], [
                'role' => 5,
                'uptd_id' => $uptd_id,
            ]);

            return redirect()->back()->with('success', 'Berhasil mengubah user PPK');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal mengubah user PPK');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
