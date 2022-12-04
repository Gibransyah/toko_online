<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alamat;


class AlamatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $table = Alamat::all();
        // $data = ["Data" => $siswa];
        // return $data;
        return response()->json([
            "message" => "Load data success",
            "data" => $table
        ], 200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $table = Alamat::create([
            "Desa" => $request -> Desa, 
            "Kecamatan" => $request -> Kecamatan,
            "Kabupaten" => $request -> Kabupaten,
            "Nomor_tlp" => $request -> Nomor_tlp,
        ]);
        return response()->json([
            "message" => "store success",
            "data" => $table
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
        $table = Alamat::show($id);
        if ($table) {
            return $table ;
        }else{
            return [ "message" => "Data not found "];
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
        $table = Alamat::find($id);
        if($table){
            $table->Desa = $request->Desa ? $request->Desa : $table->Desa;
            $table->Kecamatan = $request->Kecamatan ? $request->Kecamatan : $table->Kecamatan;
            $table->Kabupaten = $request->Kabupaten ? $request->Kabupaten : $table->Kabupaten;
            $table->Nomor_tlp = $request->Nomor_tlp ? $request->Nomor_tlp : $table->omor_tlp;
            $table->save();

            return $table;
        }else{
            return ["message" => "Data not found "];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delbarang = Alamat::find($id);
        if($delbarang){
            $delbarang->delete();
            return ["message" => "Delete Berhasil"];
        }else{
            return ["message" => "Delete tidak ditemukan"];
        }
    }
}