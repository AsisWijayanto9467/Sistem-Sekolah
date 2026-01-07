<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Imports\SiswaImport;
use App\Imports\SiswaUpdateImport;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SiswaImportController extends Controller
{
    public function import(Request $request) {
        $request->validate([
            "file" => "required|file|mimes:xlsx,xls"
        ]);

        $import = new SiswaImport;
        Excel::import($import, $request->file('file'));

        $siswa = Siswa::with('user', 'kelas', 'jurusan')->whereIn('nis', $import->nisList)->get();

        return response()->json([
            'success' => true,
            'message' => 'Data siswa berhasil diimport',
            'total' => $siswa->count(),
            "siswa" => $siswa
        ], 200);
    }

    public function importUpdate(Request $request) {
        $request->validate([
            "file" => "required|file|mimes:xlsx,xls"
        ]);

        $import = new SiswaUpdateImport;
        Excel::import($import, $request->file('file'));

        $siswa = Siswa::with('user', 'kelas', 'jurusan')->whereIn('nis', $import->updatedNis)->get();

        return response()->json([
            'success' => true,
            'message' => 'Data siswa berhasil diperbarui dari file excel yang baru',
            'total' => $siswa->count(),
            "siswa" => $siswa
        ], 200);
    }


}
    
