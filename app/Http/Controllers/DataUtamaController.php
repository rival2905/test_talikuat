<?php

namespace App\Http\Controllers;

use App\Models\JenisPekerjaan;
use App\Models\Konsultan;
use App\Models\Kontraktor;
use Illuminate\Http\Request;

class DataUtamaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('data-utama.index', [
            'nmps' => JenisPekerjaan::all(),
            'kontraktors' => Kontraktor::all(),
            'konsultans' => Konsultan::all(),
        ]);
    }

    public function createNmp(Request $request)
    {
        JenisPekerjaan::create([
            'kd_jenis_pekerjaan' => $request->kd_jenis_pekerjaan,
            'jenis_pekerjaan' => $request->jenis_pekerjaan,
            'satuan' => $request->satuan,
        ]);
        return redirect()->back()->with('success', 'Data Jenis Pekerjaan berhasil ditambahkan');
    }

    public function editNmp(Request $request, $id)
    {
        $nmp = JenisPekerjaan::find($id);
        $nmp->kd_jenis_pekerjaan = $request->kd_jenis_pekerjaan;
        $nmp->jenis_pekerjaan = $request->jenis_pekerjaan;
        $nmp->satuan = $request->satuan;
        $nmp->save();
        return redirect()->back()->with('success', 'Data Jenis Pekerjaan berhasil diubah');
    }

    public function deleteNmp($id)
    {
        $nmp = JenisPekerjaan::find($id);
        $nmp->delete();
        return redirect()->back()->with('success', 'Data Jenis Pekerjaan berhasil dihapus');
    }

    public function createKontraktor(Request $request)
    {
        Kontraktor::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'nama_direktur' => $request->nama_direktur,
            'no_telp' => $request->no_telp,
            'npwp' => $request->npwp,
            'email' => $request->email,
            'nama_gs' => $request->nama_gs,
            'no_rek' => $request->no_rek,
            'bank' => $request->bank,
        ]);
        return redirect()->back()->with('success', 'Data Kontraktor berhasil ditambahkan');
    }

    public function editKontraktor(Request $request, $id)
    {
        $kontraktor = Kontraktor::find($id);
        $kontraktor->nama = $request->nama;
        $kontraktor->alamat = $request->alamat;
        $kontraktor->nama_direktur = $request->nama_direktur;
        $kontraktor->no_telp = $request->no_telp;
        $kontraktor->npwp = $request->npwp;
        $kontraktor->email = $request->email;
        $kontraktor->nama_gs = $request->nama_gs;
        $kontraktor->no_rek = $request->no_rek;
        $kontraktor->bank = $request->bank;
        $kontraktor->save();
        return redirect()->back()->with('success', 'Data Kontraktor berhasil diubah');
    }

    public function deleteKontraktor($id)
    {
        $kontraktor = Kontraktor::find($id);
        $kontraktor->delete();
        return redirect()->back()->with('success', 'Data Kontraktor berhasil dihapus');
    }

    function createKonsultan(Request $request)
    {
        Konsultan::create([
            'name' => $request->nama,
            'alamat' => $request->alamat,
            'nama_direktur' => $request->nama_direktur,
            'no_telp' => $request->no_telp,
            'npwp' => $request->npwp,
            'email' => $request->email,
            'se' => $request->nama_se,
        ]);
        return redirect()->back()->with('success', 'Data Konsultan berhasil ditambahkan');
    }

    public function editKonsultan(Request $request, $id)
    {
        $konsultan = Konsultan::find($id);
        $konsultan->nama = $request->nama;
        $konsultan->alamat = $request->alamat;
        $konsultan->nama_direktur = $request->nama_direktur;
        $konsultan->no_telp = $request->no_telp;
        $konsultan->npwp = $request->npwp;
        $konsultan->email = $request->email;
        $konsultan->se = $request->nama_se;
        $konsultan->save();
        return redirect()->back()->with('success', 'Data Konsultan berhasil diubah');
    }

    public function deleteKonsultan($id)
    {
        $konsultan = Konsultan::find($id);
        $konsultan->delete();
        return redirect()->back()->with('success', 'Data Konsultan berhasil dihapus');
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
