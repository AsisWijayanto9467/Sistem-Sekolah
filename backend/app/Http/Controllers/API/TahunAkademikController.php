<?php

namespace App\Http\Controllers;

use App\Models\TahunAkademik;
use Illuminate\Http\Request;

class TahunAkademikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tahun = TahunAkademik::all();

        return response()->json([
            "success" => true,
            "message" => "Berhasil memanggil",
            "tahun" => $tahun
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
            "tahun" => "required|string"
        ]);

        $tahun = TahunAkademik::create([
            "tahun" => $request->tahun,
            "status" => "tidak aktif"
        ]);

        return response()->json([
            "success" => true,
            "message" => "Berhasil tambah",
            "data" => $tahun
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tahun = TahunAkademik::find($id);

        if(!$tahun) {
            return response()->json([
                "success" => false,
                "message" => "tidak ada tahun akademik dengan id ini",
            ], 400);
        }

        return response()->json([
            "success" => true,
            "message" => "Berhasil mengambil data",
            "data" => $tahun
        ], 200);
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
        $tahun = TahunAkademik::find($id);

        if(!$tahun) {
            return response()->json([
                "success" => false,
                "message" => "tidak ada tahun aka demik dengan id ini",
            ], 400);
        }

        $validated = $request->validate([
            "tahun" => "required|string|unique:tahun_akademik,tahun," . $id,
        ]);

        $tahun->update($validated);

        return response()->json([
            "success" => true,
            "message" => "Berhasil diupdate",
            "data" => $tahun
        ], 201);
    }

    public function toggleStatus($id){
        $tahun = TahunAkademik::find($id);

        if (!$tahun) {
            return response()->json([
                "success" => false,
                "message" => "tidak ada tahun akademik dengan id ini"
            ], 404);
        }

        if ($tahun->status === 'tidak aktif') {
            TahunAkademik::where('status', 'aktif')->update([
                'status' => 'tidak aktif'
            ]);
        }

        $tahun->update([
            'status' => $tahun->status === 'aktif'
                ? 'tidak aktif'
                : 'aktif'
        ]);

        return response()->json([
            "success" => true,
            "message" => "Status berhasil diubah",
            "data" => $tahun
        ], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tahun = TahunAkademik::find($id);

        if(!$tahun) {
            return response()->json([
                "success" => false,
                "message" => "tidak ada tahun aka demik dengan id ini",
            ], 400);
        }

        $tahun->delete();

        return response()->json([
            "success" => true,
            "message" => "Berhasil dihapus",
        ]);
    }
}
