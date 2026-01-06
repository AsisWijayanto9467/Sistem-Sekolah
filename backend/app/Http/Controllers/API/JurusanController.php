<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jurusan = Jurusan::all();

        return response()->json([
            "success" => true,
            "message" => "berhasil mengambil",
            "jurusan" => $jurusan
        ], 200);
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
            "kode_jurusan" => "required|max:20|string|unique:jurusan,kode_jurusan,",
            "nama_jurusan" => "required"
        ]);

        $data = Jurusan::create([
            "kode_jurusan" => $request->kode_jurusan,
            "nama_jurusan" => $request->nama_jurusan
        ]);

        return response()->json([
            "success" => true,
            "message" => "berhasil menambah data jurusan",
            "data" => $data
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $jurusan = Jurusan::find($id);

        if(!$jurusan) {
            return response()->json([
                "success" => false,
                "message" => "tidak ada jurusan dengan id ini",
            ], 400);
        }

        return response()->json([
            "success" => true,
            "message" => "berhasil mengambil data",
            "jurusan" => $jurusan
        ], 201);
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
        $jurusan = Jurusan::find($id);

        if(!$jurusan) {
            return response()->json([
                "success" => false,
                "message" => "tidak ada jurusan dengan id ini",
            ], 400);
        }

        $validated = $request->validate([
            "kode_jurusan" => "required|max:20|string|unique:jurusan,kode_jurusan," . $id,
            "nama_jurusan" => "required"
        ]);

        $jurusan->update($validated);

        return response()->json([
            "success" => true,
            "message" => "berhasil mengupdate data jurusan",
            "data" => $jurusan
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jurusan = Jurusan::find($id);

        if(!$jurusan) {
            return response()->json([
                "success" => false,
                "message" => "tidak ada jurusan dengan id ini",
            ], 400);
        }

        $jurusan->delete();

        return response()->json([
            "success" => true,
            "message" => "Berhasil dihapus",
        ]);
    }
}
