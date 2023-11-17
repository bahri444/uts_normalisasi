<?php

namespace App\Http\Controllers;

use App\Models\Kebutuhan;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class KebutuhanController extends Controller
{

    // function get all data
    public function GetAllKebutuhan()
    {
        $data = Kebutuhan::with('JoinToPegawai')->get();
        // dd($data);
        $pegawai = Pegawai::select('pegawai_id', 'nama')->get();
        return view('/kebutuhan', [
            'title' => 'pegawai',
            'data' => $data,
            'pegawai' => $pegawai,
        ]);
    }

    // function add
    public function AddKebutuhan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pegawai_id' => 'required',
            'jenis_kebutuhan' => 'required',
            'kebutuhan_tentang' => 'required',
            'deskripsi_kebutuhan' => 'required',
            'foto_video' => 'required|image|mimes:png,svg|max:5000'
        ]);
        // dd($validator);
        try {
            if (!$validator->fails()) {
                $getFile = $request->file('foto_video'); //ambil file yang di upload dari gambar
                $getFileName = $getFile->hashName(); //hash nama file yang di upload
                $direktory = "/foto_video/$getFileName";
                $request->foto_video->move(public_path('/foto_video/'), $getFileName);
            } elseif ($request->fails()) {
                return redirect('/kebutuhan')->with('messages', 'foto tidak boleh kosong');
            }
            $data = new Kebutuhan([
                'pegawai_id' => $request->pegawai_id,
                'jenis_kebutuhan' => $request->jenis_kebutuhan,
                'kebutuhan_tentang' => $request->kebutuhan_tentang,
                'deskripsi_kebutuhan' => $request->deskripsi_kebutuhan,
                'foto_video' => $direktory
            ]);
            // dd($data);
            $data->save();
            return redirect('/kebutuhan')->with('success', 'data berhasil di simpan');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('/kebutuhan')->with('message', 'gagal di tambahkan');
        }
    }

    // functtion update
    public function UpdateKebutuhan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pegawai_id' => 'required',
            'jenis_kebutuhan' => 'required',
            'kebutuhan_tentang' => 'required',
            'deskripsi_kebutuhan' => 'required',
            'foto_video' => 'required'
        ]);
        try {
            if (!$validator->fails()) {
                $getFile = $request->file('foto_video'); //ambil file yang di upload dari gambar
                $getFileName = $getFile->hashName(); //hash nama file yang di upload
                $direktory = "/foto_video/$getFileName";
                $request->foto_video->move(public_path('/foto_video/'), $getFileName);
            } elseif ($request->fails()) {
                return redirect('/kebutuhan')->with('messages', 'foto tidak boleh kosong');
            }
            $data = array(
                'pegawai_id' => $request->post('pegawai_id'),
                'jenis_kebutuhan' => $request->post('jenis_kebutuhan'),
                'kebutuhan_tentang' => $request->post('kebutuhan_tentang'),
                'deskripsi_kebutuhan' => $request->post('deskripsi_kebutuhan'),
                'foto_video' => $direktory
            );
            // dd($data);
            Kebutuhan::where('kebutuhan_id', '=', $request->post('kebutuhan_id'))->update($data);
            return redirect('/kebutuhan')->with('success', 'data berhasil di update');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('/kebutuhan')->with('message', 'gagal di update');
        }
    }

    // function delete
    public function DeleteKebutuhan($id)
    {
        try {
            Kebutuhan::where('kebutuhan_id', '=', $id)->delete();
            return redirect('/kebutuhan')->with('success', 'data berhasil di hapus..!');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('/kebutuhan')->with('message', 'gagal di hapus');
        }
    }
}
