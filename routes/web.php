<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\ActividadController;
use App\Http\Controllers\ProfileController;

// Ruta de inicio (dashboard)
Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


// Rutas para autenticación 
require __DIR__.'/auth.php';

// Rutas para Asistencias
Route::middleware(['auth'])->group(function () {
    Route::get('/asistencias', [AsistenciaController::class, 'index'])->name('asistencias.index');
    Route::get('/asistencias/crear', [AsistenciaController::class, 'create'])->name('asistencias.create');
    Route::post('/asistencias', [AsistenciaController::class, 'store'])->name('asistencias.store');
    Route::get('/asistencias/estadisticas', [AsistenciaController::class, 'estadisticas'])->name('asistencias.estadisticas'); 
});


// Rutas para Actividades
Route::middleware(['auth'])->group(function () {
    Route::get('/actividades', [ActividadController::class, 'index'])->name('actividades.index');
    Route::get('/actividades/crear', [ActividadController::class, 'create'])->name('actividades.create');
    Route::post('/actividades', [ActividadController::class, 'store'])->name('actividades.store');
    Route::get('/actividades/{actividad}/edit', [ActividadController::class, 'edit'])->name('actividades.edit'); // Ruta  para editar
    Route::put('/actividades/{actividad}', [ActividadController::class, 'update'])->name('actividades.update'); // Ruta para actualizar (PUT)
    Route::delete('/actividades/{actividad}', [ActividadController::class, 'destroy'])->name('actividades.destroy'); // Ruta para eliminar
});
// Ruta para editar el perfil
Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit'); 
});

Route::get('/css/style.css', function () {
    return response()->file(public_path('css/style.css'), [
        'Cache-Control' => 'no-store, no-cache, must-revalidate',
        'Pragma' => 'no-cache',
    ]);
});
