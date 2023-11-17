<?php

namespace App\Http\Controllers;

use App\Models\Bagian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class BagianController extends Controller
{
    // function get all data
    public function GetAllBagian()
    {
        $data = Bagian::all();
        // dd($data);
        return view('/bagian', ['data' => $data]);
    }

    // function add
    public function AddBagian(Request $request)
    {
        Validator::make($request->all(), [
            'bagian' => 'required'
        ]);
        try {
            $data = new Bagian([
                'bagian' => $request->bagian
            ]);
            // dd($data);
            $data->save();
            return redirect('/bagian')->with('success', 'data berhasil di simpan');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('/bagian')->with('message', 'gagal di tambahkan');
        }
    }

    // functtion update
    public function UpdateBagian(Request $request)
    {
        Validator::make($request->all(), [
            'bagian' => 'required'
        ]);
        try {
            $data = array(
                'bagian' => $request->post('bagian')
            );
            // dd($data);
            Bagian::where('bagian_id', '=', $request->post('bagian_id'))->update($data);
            return redirect('/bagian')->with('success', 'data berhasil di update');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('/bagian')->with('message', 'gagal di update');
        }
    }

    // function delete
    public function DeleteBagian($id)
    {
        try {
            Bagian::where('bagian_id', '=', $id)->delete();
            return redirect('/bagian')->with('success', 'data berhasil di hapus..!');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('/bagian')->with('message', 'gagal di hapus');
        }
    }
}
