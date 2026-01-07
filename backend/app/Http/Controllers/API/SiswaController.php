<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = Siswa::with("user", "jurusan", "kelas")->get();

        return response()->json([
            "success" => true,
            "message" => "berhasil mengambil data siswa",
            "siswa" => $siswa
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
            "nis" => "required|string|max:30|unique:siswa,nis",
            "nama_lengkap" => "required|string|unique:siswa,nama_lengkap",
            "tempat_lahir" => "required|string",
            "tanggal_lahir" => "required",
            "jenis_kelamin" => "required|in:laki-laki, perempuan",
            "jurusan_id" => "nullable|exists:jurusan,id",
            "kelas_id" => "nullable|exists:kelas,id",
            "nama_orang_tua" => "required|string",
            "alamat" => "required",

            "username" => "required|unique:users,username",
            "password" => "required"
        ]);

        $siswa = DB::transaction(function() use($request) {
            $siswa = Siswa::create([
                "nis" => $request->nis,
                "nama_lengkap" => $request->nama_lengkap,
                "tempat_lahir" => $request->tempat_lahir,
                "tanggal_lahir" => $request->tanggal_lahir,
                "jenis_kelamin" => $request->jenis_kelamin,
                "jurusan_id" => $request->jurusan_id,
                "kelas_id" => $request->kelas_id,
                "nama_orang_tua" => $request->nama_orang_tua,
                "alamat" => $request->alamat,
            ]);

            User::create([
                "guru_id" => null,
                "siswa_id" => $siswa->id,
                "username" => $request->username,
                "password" => Hash::make($request->password),
                "status" => "siswa"
            ]);

            return $siswa;
        });

        return response()->json([
            "success" => true,
            "message" => "Anda Berhasil Menambah Siswa",
            "siswa" => $siswa->load("user", "jurusan", "kelas")
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $siswa = Siswa::with("user", "jurusan", "kelas")->find($id);

        if(!$siswa) {
            return response()->json([
                "success" => false,
                "message" => "siswa dengan id yang anda berikan tidak bisa ditemukan"
            ], 400);
        }

        return response()->json([
            "success" => true,
            "message" => "berhasil mengambil data siswa",
            "siswa" => $siswa
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
        $siswa = Siswa::with("user", "jurusan", "kelas")->find($id);

        if(!$siswa) {
            return response()->json([
                "success" => false,
                "message" => "siswa dengan id yang anda berikan tidak bisa ditemukan"
            ]);
        }

        if(!$siswa->user) {
             return response()->json([
                "success" => false,
                "message" => "akun siswa belum tersedia",
            ], 400);
        }

        $validated = $request->validate([
            "nis" => "required|string|max:30|unique:siswa,nis," . $id,
            "nama_lengkap" => "required|string|unique:siswa,nama_lengkap," . $id,
            "tempat_lahir" => "required|string",
            "tanggal_lahir" => "required",
            "jenis_kelamin" => "required|in:laki-laki, perempuan",
            "jurusan_id" => "nullable|exists:jurusan,id",
            "kelas_id" => "nullable|exists:kelas,id",
            "nama_orang_tua" => "required|string",
            "alamat" => "required",

            "username" => "required|unique:users,username," . $siswa->user->id,
            "password" => "required"
        ]);

        $siswa = DB::transaction(function() use($siswa, $validated) {
            $siswa->update(collect($validated)->except(['username', 'password'])->toArray());

            $userData = [
                "username" => $validated["username"]
            ];

            if(!empty($validated['password'])) {
                $userData['password'] = Hash::make($validated["password"]);
            }

            $siswa->user->update($userData);

            return $siswa;
        });

        return response()->json([
            "success" => true,
            "message" => "Anda Berhasil Mengupdate Siswa",
            "siswa" => $siswa
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $siswa = Siswa::with("user", "jurusan", "kelas")->find($id);

        if(!$siswa) {
            return response()->json([
                "success" => false,
                "message" => "siswa dengan id yang anda berikan tidak bisa ditemukan"
            ]);
        }

        DB::transaction(function() use($siswa) {
            $siswa->user()->delete();
            $siswa->delete();
        });
        
        return response()->json([
            "success" => true,
            "message" => "siswa dan akun berhasil dihapus",
        ]);
    }
}
