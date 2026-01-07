<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guru = Guru::with("user")->get();

        return response()->json([
            "success" => true,
            "message" => "Berhasil mengambil data",
            "guru" => $guru
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
            "nip" => "required|string|max:30|unique:guru,nip",
            "kode_guru" => "required|string|max:20|unique:guru,kode_guru",
            "nama_lengkap" => "required|string",
            "tempat_lahir" => "required|string",
            "tanggal_lahir" => "required",
            "jenis_kelamin" => "required|in:laki-laki, perempuan",
            "gelar_depan" => "nullable|string",
            "gelar_belakang" => "nullable|string",
            "alamat" => "required",
            "honor_per_jam" => "required|numeric",
            "foto" => "nullable|string",
            "mulai_tugas" => "required",

            "username" => "required|unique:users,username",
            "password" => "required",
        ]);

        $guru = DB::transaction(function () use($request) {
            $guru = Guru::create([
                "nip" => $request->nip,
                "kode_guru" => $request->kode_guru,
                "nama_lengkap" => $request->nama_lengkap,
                "tempat_lahir" => $request->tempat_lahir,
                "tanggal_lahir" => $request->tanggal_lahir,
                "jenis_kelamin" => $request->jenis_kelamin,
                "gelar_depan" => $request->gelar_depan,
                "gelar_belakang" => $request->gelar_belakang,
                "alamat" => $request->alamat,
                "honor_per_jam" => $request->honor_per_jam,
                "foto" => $request->foto,
                "mulai_tugas" => $request->mulai_tugas,
            ]);

            User::create([
                "guru_id" => $guru->id,
                "siswa_id" => null,
                "username" => $request->username,
                "password" => Hash::make($request->password),
                "status" => "guru"
            ]);

            return $guru;
        });

        return response()->json([
            "success" => true,
            "message" => "Berhasil menambahkan data guru",
            "guru" => $guru->load('user')
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $guru = Guru::with("user")->find($id);

        if(!$guru) {
             return response()->json([
                "success" => false,
                "message" => "tidak ada guru dengan id ini",
            ], 400);
        }

        return response()->json([
            "success" => true,
            "message" => "Berhasil mengambil data",
            "guru" => $guru
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
        $guru = Guru::with("user")->find($id);

        if(!$guru) {
             return response()->json([
                "success" => false,
                "message" => "tidak ada guru dengan id ini",
            ], 400);
        }

        if(!$guru->user) {
             return response()->json([
                "success" => false,
                "message" => "akun guru belum tersedia",
            ], 400);
        }

        $validated = $request->validate([
            "nip" => "required|string|max:30|unique:guru,nip," . $id,
            "kode_guru" => "required|string|max:20|unique:guru,kode_guru," . $id,
            "nama_lengkap" => "required|string",
            "tempat_lahir" => "required|string",
            "tanggal_lahir" => "required",
            "jenis_kelamin" => "required|in:laki-laki, perempuan",
            "gelar_depan" => "nullable|string",
            "gelar_belakang" => "nullable|string",
            "alamat" => "required",
            "honor_per_jam" => "required|numeric",
            "foto" => "nullable|string",
            "mulai_tugas" => "required",

            "username" => "required|unique:users,username," . $guru->user->id,
            "password" => "nullable|min:6",
        ]);

        $guru = DB::transaction(function () use($guru, $validated) {
            $guru->update(collect($validated)->except(['username', 'password'])->toArray());

            $userData = [
                "username" => $validated["username"]
            ];

            if(!empty($validated['password'])) {
                $userData['password'] = Hash::make($validated["password"]);
            }

            $guru->user->update($userData);

            return $guru;
        });

        return response()->json([
            "success" => true,
            "message" => "Berhasil menambahkan data guru",
            "guru" => $guru->load('user')
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $guru = Guru::with("user")->find($id);

        if(!$guru) {
             return response()->json([
                "success" => false,
                "message" => "tidak ada guru dengan id ini",
            ], 400);
        }

        DB::transaction(function() use($guru) {
            $guru->user()->delete();
            $guru->delete();
        });

        return response()->json([
            "success" => true,
            "message" => "Guru dan akun berhasil dihapus",
        ]);
    }
}
