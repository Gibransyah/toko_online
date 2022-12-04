<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Order::all();
        return response()->json([
            "message" => "load data success",
            "data" => $data
        ], 200);
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
            "id_user" => "Masukan id user",
            "id_barang" => "Masukan id barang",
            "nama_barang" => "Masukan nama barang",
            "jumlah_barang" => "Masukan jumlah barang",
            "harga_barang" => "Masukan harga barang",
            "Desa" => "Masukan nama desa",
            "Kecamatan" => "Masukan nama kecamatan",
            "Kabupaten" => "Masukan nama kabupaten",
            "Nomor_tlp" => "Masukan nomor telephon"
        ];
        $validasi = Validator::make($request->all(),[
            "id_user" => "required",
            "id_barang" => "required",
            "nama_barang" => "required",
            "jumlah_barang" => "required",
            "harga_barang" => "required",
            "Desa" => "required",
            "Kecamatan" => "required",
            "Kabupaten" => "required",
            "Nomor_tlp" => "required"

        ], $message);
        if ($validasi->fails()) {
            return $validasi->errors();
        }
        $data = Order::create($validasi->validate());
        $data->save();

        return response()->json([
            "message" => "Data success",
            "data" => $data
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $barang = Order::find($id);
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
        $barang = Order::findOrFail($id);
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
        $delbarang = Order::find($id);
        if($delbarang){
            $delbarang->delete();
            return ["message" => "Delete Berhasil"];
        }else{
            return ["message" => "Delete tidak ditemukan"];
        }
    }
}
