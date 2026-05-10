<?php

use App\Http\Controllers\API\CursosController;
use App\Http\Controllers\API\PuestosController;
use App\Http\Controllers\API\SEPOMEXController;
use App\Http\Controllers\API\UnidadesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/unidades/getUnidadClues/{clues}', [UnidadesController::class, 'getUnidadClues']);
Route::get('/puestos/getBase/{id}', [PuestosController::class, 'getBase']);
Route::get('/puestos/getPuesto/{id}', [PuestosController::class, 'getPuesto']);
Route::get('/turnos/{turno}', [PuestosController::class, 'getHorasTurno']);
Route::get('/puestos/getPuestoCodigo/{codigo}', [PuestosController::class, 'getPuestoCodigo']);

Route::get('/cursos/{id_curso}', [CursosController::class, 'getCurso']);

Route::name('api.')->group(function () {
    Route::apiResource('/sepomex', SEPOMEXController::class)->only(['index', 'show']);
    Route::apiResource('/puestos', PuestosController::class)->only(['index', 'show']);
    Route::apiResource('/unidades', UnidadesController::class)->only(['index', 'show']);
});
