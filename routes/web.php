<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\CursosController;
use App\Http\Controllers\DomiciliosController;
use App\Http\Controllers\EmpleadosController;
use App\Http\Controllers\EspecialidadesMedicasController;
use App\Http\Controllers\EstudiosController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovimientosUnidadController;
use App\Http\Controllers\UnidadesController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

// BIENVENIDA Y PAGINA PRINCIPAL
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'welcome']);

// Cambio de Contraseña
Route::get('/changePassword', [HomeController::class, 'showChangePasswordForm']);
Route::post('/changePassword', [HomeController::class, 'changePassword'])->name('changePassword');

// Usuarios
// Laravel Breeze provides authentication routes

Route::get('movimientos_unidad/generar_documento', [MovimientosUnidadController::class, 'generarDocumento'])->name('movimientos_unidad.generarDocumento');

Route::get('/empleados/{id_empleado}/domicilios', [DomiciliosController::class, 'index'])->name('empleados.domicilios.index');
Route::get('/empleados/{id_empleado}/domicilios/crear', [DomiciliosController::class, 'create'])->name('empleados.domicilios.create');
Route::post('/empleados/{id_empleado}/domicilios', [DomiciliosController::class, 'store'])->name('empleados.domicilios.store');
Route::get('/empleados/{id_empleado}/domicilios/{id_domicilio}/edit', [DomiciliosController::class, 'edit'])->name('empleados.domicilios.edit');
Route::patch('/empleados/{id_empleado}/domicilios/{id_domicilio}', [DomiciliosController::class, 'update'])->name('empleados.domicilios.update');
Route::delete('/empleados/{id_empleado}/domicilios/{id_domicilio}', [DomiciliosController::class, 'destroy'])->name('empleados.domicilios.destroy');

Route::get('/empleados/{id_empleado}/estudios', [EstudiosController::class, 'index'])->name('empleados.estudios.index');
Route::get('/empleados/{id_empleado}/estudios/crear', [EstudiosController::class, 'create'])->name('empleados.estudios.create');
Route::post('/empleados/{id_empleado}/estudios', [EstudiosController::class, 'store'])->name('empleados.estudios.store');
Route::get('/empleados/{id_empleado}/estudios/{id_estudio}/edit', [EstudiosController::class, 'edit'])->name('empleados.estudios.edit');
Route::patch('/empleados/{id_empleado}/estudios/{id_estudio}', [EstudiosController::class, 'update'])->name('empleados.estudios.update');
Route::delete('/empleados/{id_empleado}/estudios/{id_estudio}', [EstudiosController::class, 'destroy'])->name('empleados.estudios.destroy');

Route::get('/empleados/{id_empleado}/cursos', [CursosController::class, 'index'])->name('empleados.cursos.index');
Route::get('/empleados/{id_empleado}/cursos/crear', [CursosController::class, 'create'])->name('empleados.cursos.create');
Route::post('/empleados/{id_empleado}/cursos', [CursosController::class, 'store'])->name('empleados.cursos.store');
Route::get('/empleados/{id_empleado}/cursos/{id_curso}/edit', [CursosController::class, 'edit'])->name('empleados.cursos.edit');
Route::patch('/empleados/{id_empleado}/cursos/{id_curso}', [CursosController::class, 'update'])->name('empleados.cursos.update');
Route::delete('/empleados/{id_empleado}/cursos/{id_curso}', [CursosController::class, 'destroy'])->name('empleados.cursos.destroy');

Route::get('/empleados/{id_empleado}/especialidad_medica', [EspecialidadesMedicasController::class, 'index'])->name('empleados.especialidad_medica.index');
Route::get('/empleados/{id_empleado}/especialidad_medica/crear', [EspecialidadesMedicasController::class, 'create'])->name('empleados.especialidad_medica.create');
Route::post('/empleados/{id_empleado}/especialidad_medica', [EspecialidadesMedicasController::class, 'store'])->name('empleados.especialidad_medica.store');
Route::get('/empleados/{id_empleado}/especialidad_medica/{id_especialidad_medica}/edit', [EspecialidadesMedicasController::class, 'edit'])->name('empleados.especialidad_medica.edit');
Route::patch('/empleados/{id_empleado}/especialidad_medica/{id_especialidad_medica}', [EspecialidadesMedicasController::class, 'update'])->name('empleados.especialidad_medica.update');
Route::delete('/empleados/{id_empleado}/especialidad_medica/{id_especialidad_medica}', [EspecialidadesMedicasController::class, 'destroy'])->name('empleados.especialidad_medica.destroy');

// Acerca de
Route::get('acerca_de/puestos_homologos', [AboutController::class, 'getPuestosHomologos'])->name('about.homologos');

Route::resource('users', UsersController::class);
Route::resource('empleados', EmpleadosController::class);
Route::resource('unidades', UnidadesController::class);

require __DIR__.'/auth.php';
