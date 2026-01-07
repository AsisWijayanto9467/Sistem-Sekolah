<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = Kelas::with("WaliKelas")->get();

        return response()->json([
            "Success"  => true,
            "message" => "Berhasil Mengambil data",
            "kelas" => $kelas
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
            "kode_kelas" => "required|max:20|unique:kelas,kode_kelas",
            "nama_kelas" => "required|string",
            "wali_kelas_id" => "nullable|exists:guru,id",
            "jumlah_pembayaran" => "required|numeric|min:0"
        ]);


        $kelas = Kelas::create([
            "kode_kelas" => $request->kode_kelas,
            "nama_kelas" => $request->nama_kelas,
            "wali_kelas_id" => $request->wali_kelas_id,
            "jumlah_pembayaran" => $request->jumlah_pembayaran
        ]);

        return response()->json([
            "success" => true,
            "message" => "anda berhasil memasukan data kelas",
            "kelas" => $kelas
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kelas = Kelas::with("WaliKelas")->get($id);

        if(!$kelas) {
            return response()->json([
                "success" => false,
                "message" => "tidak ada data yang sesuai dengan id"
            ]);
        }

        return response()->json([
            "Success"  => true,
            "message" => "Berhasil Mengambil data",
            "kelas" => $kelas
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
        $kelas = Kelas::with("WaliKelas")->get($id);

        if(!$kelas) {
            return response()->json([
                "success" => false,
                "message" => "tidak ada data yang sesuai dengan id"
            ]);
        }

        $validated = $request->validate([
            "kode_kelas" => "required|max:20|unique:kelas,kode_kelas",
            "nama_kelas" => "required|string",
            "wali_kelas_id" => "nullable|exists:guru,id",
            "jumlah_pembayaran" => "required|numeric|min:0"
        ]);

        $kelas->update($validated);

        return response()->json([
            "success" => true,
            "message" => "anda berhasil mengupdate data kelas",
            "kelas" => $kelas
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kelas = Kelas::with("WaliKelas")->get($id);

        if(!$kelas) {
            return response()->json([
                "success" => false,
                "message" => "tidak ada data yang sesuai dengan id"
            ]);
        }

        $kelas->delete();

        return response()->json([
            "success" => true,
            "message" => "anda berhasil menghapus data ini"
        ]);
    }
}
