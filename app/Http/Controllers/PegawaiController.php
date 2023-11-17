<?php

namespace App\Http\Controllers;

use App\Models\Bagian;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PegawaiController extends Controller
{
    // function get all data
    public function GetAllPegawai()
    {
        $data = Pegawai::with('JoinToBagian')->get();
        // dd($data);
        $bagian = Bagian::select('bagian_id', 'bagian')->get();
        return view('/pegawai', [
            'title' => 'pegawai',
            'data' => $data,
            'bagian' => $bagian,
        ]);
    }

    // function add
    public function AddPegawai(Request $request)
    {
        Validator::make($request->all(), [
            'bagian_id' => 'required',
            'nama' => 'required',
            'kontak_wa' => 'required'
        ]);
        try {
            $data = new Pegawai([
                'bagian_id' => $request->bagian_id,
                'nama' => $request->nama,
                'kontak_wa' => $request->kontak_wa
            ]);
            // dd($data);
            $data->save();
            return redirect('/pegawai')->with('success', 'data berhasil di simpan');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('/pegawai')->with('message', 'gagal di tambahkan');
        }
    }

    // functtion update
    public function UpdatePegawai(Request $request)
    {
        Validator::make($request->all(), [
            'bagian_id' => 'required',
            'nama' => 'required',
            'kontak_wa' => 'required'
        ]);
        try {
            $data = array(
                'bagian_id' => $request->post('bagian_id'),
                'nama' => $request->post('nama'),
                'kontak_wa' => $request->post('kontak_wa')
            );
            // dd($data);
            Pegawai::where('pegawai_id', '=', $request->post('pegawai_id'))->update($data);
            return redirect('/pegawai')->with('success', 'data berhasil di update');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('/pegawai')->with('message', 'gagal di update');
        }
    }

    // function delete
    public function DeletePegawai($id)
    {
        try {
            Pegawai::where('pegawai_id', '=', $id)->delete();
            return redirect('/pegawai')->with('success', 'data berhasil di hapus..!');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('/pegawai')->with('message', 'gagal di hapus');
        }
    }
}
