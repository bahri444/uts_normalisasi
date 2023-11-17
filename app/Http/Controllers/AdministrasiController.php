<?php

namespace App\Http\Controllers;

use App\Models\Administrasi;
use App\Models\Kebutuhan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AdministrasiController extends Controller
{
    public function GetAllAdministration()
    {
        $data = Administrasi::with('JoinToKebutuhan')->get();
        $kebutuhan = Kebutuhan::select('kebutuhan_id', 'jenis_kebutuhan')->get();
        // dd($data);
        return view('/administrasi', [
            'title' => 'administrasi',
            'data' => $data,
            'kebutuhan' => $kebutuhan,
        ]);
        // 'kebutuhan_id',    'urgenci',    'kategori',    'progres'
    }
    public function AddAdministration(Request $request)
    {
        Validator::make($request->all(), [
            'kebutuhan_id' => 'required',
            'urgenci' => 'required',
            'kategori' => 'required',
            'progres' => 'required'
        ]);
        try {
            $data = new Administrasi([
                'kebutuhan_id' => $request->kebutuhan_id,
                'urgenci' => $request->urgenci,
                'kategori' => $request->kategori,
                'progres' => $request->progres
            ]);
            // dd($data);
            $data->save();
            return redirect('/administrasi')->with('success', 'data berhasil di simpan');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('/administrasi')->with('message', 'gagal di tambahkan');
        }
    }
    public function UpdateAdministration(Request $request)
    {
        Validator::make($request->all(), [
            'kebutuhan_id' => 'required',
            'urgenci' => 'required',
            'kategori' => 'required',
            'progres' => 'required'
        ]);
        try {
            $data = array(
                'kebutuhan_id' => $request->post('kebutuhan_id'),
                'urgenci' => $request->post('urgenci'),
                'kategori' => $request->post('kategori'),
                'progres' => $request->post('progres')
            );
            Administrasi::where('administrasi_id', '=', $request->post('administrasi_id'))->update($data);

            return redirect('/administrasi')->with('success', 'data berhasil di update');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('/administrasi')->with('message', 'gagal di update');
        }
    }
    public function DeleteAdministrasi($id)
    {
        try {
            Administrasi::where('administrasi_id', '=', $id)->delete();
            return redirect('/administrasi')->with('success', 'data berhasil di hapus..!');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('/administrasi')->with('message', 'gagal di hapus');
        }
    }
}
