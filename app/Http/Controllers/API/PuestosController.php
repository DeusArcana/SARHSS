<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Base;
use App\Models\Puesto;
use App\Models\ServicioPuesto;
use DB;

class PuestosController extends Controller
{
    public function show($id)
    {
        $puestos = DB::select('call Info_SSN.select_servicio_puesto(?,?)', [4, $id]);

        return response()->json($puestos);
    }

    public function getPuestoCodigo($codigo)
    {
        $puesto = collect(Puesto::Where('Codigo', $codigo)->orderBy('ID_Puesto', 'desc')->get(['ID_Puesto', 'Codigo', 'Nombre']))->shift();

        return response()->json($puesto);
    }

    public function getBase($id)
    {
        $base = collect(Base::find($id))->only(['Codigo', 'Complemento_Clave_Presupuestal'])->toArray();

        return response()->json($base);
    }

    public function getPuesto($id)
    {
        $serviciopuesto = collect(ServicioPuesto::find($id))->only(['Puesto_ID_Puesto'])->shift();

        $puesto = collect(Puesto::find($serviciopuesto))->only(['Codigo'])->toArray();

        return response()->json($puesto);
    }

    public function getHorasTurno($turno)
    {
        $horas = DB::select('call Empl_SSN.select_turnos(?)', [$turno]);

        return response()->json($horas);
    }
}
