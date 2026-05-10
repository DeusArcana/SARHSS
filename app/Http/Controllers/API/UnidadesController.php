<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\BaseRepositoryInterface;
use DB;

class UnidadesController extends Controller
{
    protected $unidad;

    public function __construct(BaseRepositoryInterface $unidad)
    {
        $this->unidad = $unidad;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $unidad = collect($this->unidad->find(1, $id))->only(['ID_Unidad', 'Nombre'])->toArray();

        return response()->json($unidad);
    }

    public function getUnidades($ID_Servicio_Puesto)
    {
        $unidades = DB::select('call Info_SSN.select_unidad_puestos(?)', [$ID_Servicio_Puesto]);

        return response()->json($unidades);
    }

    public function getUnidadClues($clues)
    {
        $unidad = collect(DB::select('call Info_SSN.select_unidad_clues(?)', [$clues]))->shift();

        return response()->json($unidad);
    }
}
