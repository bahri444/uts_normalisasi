<?php

namespace App\Http\Controllers;

use App\Models\Administrasi;
use App\Models\PenanggungJawab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PenanggungJawabController extends Controller
{

    // function get all data
    public function GetAllPenanggungJawab()
    {
        $data = PenanggungJawab::with('JoinToAdministrasi')->get();
        $Administrasi = Administrasi::select('administrasi_id', 'urgenci')->get();
        // dd($Administrasi);
        return view('/penanggungjawab', [
            'title' => 'penanggungjawab',
            'data' => $data,
            'administrasi' => $Administrasi,
        ]);
    }

    // function add
    public function AddPenanggungJawab(Request $request)
    {
        Validator::make($request->all(), [
            'administrasi_id' => 'required',
            'pic' => 'required'
        ]);
        try {
            $data = new PenanggungJawab([
                'administrasi_id' => $request->administrasi_id,
                'pic' => $request->pic
            ]);
            // dd($data);
            $data->save();
            return redirect('/penanggungjawab')->with('success', 'data berhasil di simpan');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('/penanggungjawab')->with('message', 'gagal di tambahkan');
        }
    }

    // functtion update
    public function UpdatePenanggungJawab(Request $request)
    {
        Validator::make($request->all(), [
            'administrasi_id' => 'required',
            'pic' => 'required'
        ]);
        try {
            $data = array(
                'administrasi_id' => $request->post('administrasi_id'),
                'pic' => $request->post('pic')
            );
            // dd($data);
            PenanggungJawab::where('penanggung_jawab_id', '=', $request->post('penanggung_jawab_id'))->update($data);
            return redirect('/penanggungjawab')->with('success', 'data berhasil di update');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('/penanggungjawab')->with('message', 'gagal di update');
        }
    }

    // function delete
    public function DeletePenanggungJawab($id)
    {
        try {
            PenanggungJawab::where('penanggung_jawab_id', '=', $id)->delete();
            return redirect('/penanggungjawab')->with('success', 'data berhasil di hapus..!');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('/penanggungjawab')->with('message', 'gagal di hapus');
        }
    }
}
