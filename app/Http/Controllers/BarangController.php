<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Barang::all();

        return $data;
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
        $message = [
            "id_barang" => "Masukan id barang",
            "nama_barang" => "Masukan nama barang",
            "deskripsi_barang" => "Masukan deskripsi barang",
            "harga_barang" => "Masukan harga barang",
        ];
        $validasi = Validator::make($request->all(),[
            "id_barang" => "required",
            "nama_barang" => "required",
            "deskripsi_barang" => "required",
            "harga_barang" => "required",
        ], $message);
        if ($validasi ->fails()) {
            return $validasi -> errors();
        }
        $barang = Barang::create($validasi->validate());
        $barang->save();

        return response()->json([
            "message"=>"load data success",
            "data"=>$barang
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $barang = Barang::find($id);
        if($barang){
            return $barang;
        }else{
            return ["message" => "Data tidak dapat ditemukan"];
        }
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
        $barang = Barang::findOrFail($id);
        $barang->update($request->all());
        $barang->save();

        return $barang;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delbarang = Barang::find($id);
        if($delbarang){
            $delbarang->delete();
            return ["message" => "Delete Berhasil"];
        }else{
            return ["message" => "Delete tidak ditemukan"];
        }
    }
}
