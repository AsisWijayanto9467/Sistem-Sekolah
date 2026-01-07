<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mapel = MataPelajaran::with("guru")->get();

        return response()->json([
            "success" => true,
            "message" => "berhasil mengambil data mapel",
            "mapel" => $mapel
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "kode_mapel" => "required|max:20|unique:kelas,kode_kelas",
            "nama_mapel" => "required|string",
            "guru_id" => "nullable|exists:guru,id",
            "kkm" => "required|numeric|min:0"
        ]);


        $mapel = MataPelajaran::create([
            "kode_mapel" => $request->kode_mapel,
            "nama_mapel" => $request->nama_mapel,
            "guru_id" => $request->guru_id,
            "kkm" => $request->kkm
        ]);

        return response()->json([
            "success" => true,
            "message" => "anda berhasil memasukan data mapel",
            "kelas" => $mapel
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $mapel = MataPelajaran::with("guru")->find($id);

        if(!$mapel) {
            return response()->json([
                "success" => false,
                "message" => "Mapel berdasarkan id tidak ditemukan",
            ]);
        }

        return response()->json([
            "success" => true,
            "message" => "anda berhasil mengambil data mapel",
            "kelas" => $mapel
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $mapel = MataPelajaran::with("guru")->find($id);

        if(!$mapel) {
            return response()->json([
                "success" => false,
                "message" => "Mapel berdasarkan id tidak ditemukan",
            ]);
        }

        $validated = $request->validate([
            "kode_mapel" => "required|max:20|unique:kelas,kode_kelas",
            "nama_mapel" => "required|string",
            "guru_id" => "nullable|exists:guru,id",
            "kkm" => "required|numeric|min:0"
        ]);

        $mapel->update($validated);

        return response()->json([
            "success" => true,
            "message" => "anda berhasil mengupdate data mapel",
            "kelas" => $mapel
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mapel = MataPelajaran::with("guru")->find($id);

        if(!$mapel) {
            return response()->json([
                "success" => false,
                "message" => "Mapel berdasarkan id tidak ditemukan",
            ]);
        }

        $mapel->delete();

        return response()->json([
            "success" => true,
            "message" => "Mata pelajaran berhasil dihapus",
        ]);
    }
}
