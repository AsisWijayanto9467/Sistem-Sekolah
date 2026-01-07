<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\GuruController;
use App\Http\Controllers\API\JurusanController;
use App\Http\Controllers\API\KelasController;
use App\Http\Controllers\API\TahunAkademikController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post("/login", [AuthController::class, "login"]);

Route::middleware("auth:sanctum")->group(function() {
    // Tahun akademik
    Route::get("/tahun", [TahunAkademikController::class, "index"]);
    Route::post("/tahun", [TahunAkademikController::class, "store"]);
    Route::get("/tahun/{id}", [TahunAkademikController::class, "show"]);
    Route::put("/tahun/{id}", [TahunAkademikController::class, "update"]);
    Route::delete("/tahun/{id}", [TahunAkademikController::class, "destroy"]);
    // Toggle Tahun akademik
    Route::patch('/tahun/toggle-status/{id}', [TahunAkademikController::class, 'toggleStatus']);

    // Jurusan
    Route::get("/jurusan", [JurusanController::class, "index"]);
    Route::post("/jurusan", [JurusanController::class, "store"]);
    Route::get("/jurusan/{id}", [JurusanController::class, "show"]);
    Route::put("/jurusan/{id}", [JurusanController::class, "update"]);
    Route::delete("/jurusan/{id}", [JurusanController::class, "destroy"]);

    // Guru
    Route::get("/guru", [GuruController::class, "index"]);
    Route::post("/guru", [GuruController::class, "store"]);
    Route::get("/guru/{id}", [GuruController::class, "show"]);
    Route::put("/guru/{id}", [GuruController::class, "update"]);
    Route::delete("/guru/{id}", [GuruController::class, "destroy"]);

    // Kelas
    Route::get("/kelas", [KelasController::class, "index"]);
    Route::post("/kelas", [KelasController::class, "store"]);
    Route::get("/kelas/{id}", [KelasController::class, "show"]);
    Route::put("/kelas/{id}", [KelasController::class, "update"]);
    Route::delete("/kelas/{id}", [KelasController::class, "destroy"]);

    Route::post("/logout", [AuthController::class, "logout"]);
});
