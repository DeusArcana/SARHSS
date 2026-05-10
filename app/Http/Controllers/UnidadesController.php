<?php

namespace App\Http\Controllers;

use App\Repositories\BaseRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class UnidadesController extends Controller
{
    /**
     * Implementación del Repositorio
     *
     * @var unidad
     */
    protected $unidad;

    /**
     * Create a new controller instance.
     *
     * @param  BaseRepositoryInterface  $unidad  Interface to handle business logic.
     * @return void
     */
    public function __construct(BaseRepositoryInterface $unidad)
    {
        $this->unidad = $unidad;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->hasRoles(['sudo', 'admin'])) {
            // Obtenemos todas las unidades
            $unidades = $this->unidad->all();
        } elseif (Auth::user()->hasRoles(['juris'])) {
            // Obtenemos todas las unidades dada la jurisdicción del empleado
            $jurisdiccion = $this->unidad->getJurisdiccion(Auth::user()->employee);
            $unidades = $this->unidad->findBy(1, $jurisdiccion->ID_Jurisdiccion, null);
        } else {
            // Redireccionamos al usuario a la unidad a la que pertenece
            $id = $this->unidad->getUnidadUser(Auth::user()->employee)['Unidad_Fisica'];

            return redirect(route('unidades.show', encode('unidades', $id)));
        }

        return view('unidades.index', compact('unidades'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = decode('unidades', $id);
        $unidad_simple = $this->unidad->find($id);

        if (Auth::user()->can('view', $unidad_simple)) {
            // Información de la unidad
            $unidad = $this->unidad->findBy(2, $id, null);
            // Plantilla del modelo de recursos
            // $empleado_unidad_template	= $this -> unidad -> getEmpleadoTipoUnidad(5, $unidad -> Tipo_de_Unidad);
            $empleado_unidad_template = $this->unidad->getCantidadPuesto($unidad->Tipo_de_Unidad);
            // Empleados actuales de la unidad que cumplen el modelo de recursos
            $empleado_unidad_standard = $this->unidad->getEmpleadoUnidad(true, $id);
            // Empleados actuales de la unidad que NO cumplen el modelo de recursos
            $empleado_unidad_nostandard = $this->unidad->getEmpleadoUnidad(false, $id);
            // Empleados totales de la unidad
            $empleado_unidad = collect($empleado_unidad_standard)->merge($empleado_unidad_nostandard);

            // Obtenemos la siguiente información de los empleados a través del Servicio_Puesto
            $empleados_curr = [];
            $reales = [];
            $comisionados = [];

            foreach ($empleado_unidad as $item) {
                $empleados_curr[] = $item['ID_Puesto'];

                if ($item['CLUES_Fisica'] == $item['CLUES_Adscrita']) {
                    $reales[] = $item['ID_Puesto'];
                } else {
                    $comisionados[] = $item['ID_Puesto'];
                }
            }

            $empleados_curr = collect(array_count_values($empleados_curr));
            $reales = collect(array_count_values($reales));
            $comisionados = collect(array_count_values($comisionados));
            $model_is_empty = empty($empleado_unidad_template);
            // dd($model_is_empty);
            // Para el semaforo combinamos la información del modelo de recursos con los empleados actuales de la unidad
            // y se obtienen todos los puestos y servicios únicos a través del Servicio_Puesto
            $empleado_por_unidad = collect(array_merge($empleado_unidad_template, $empleado_unidad_standard, $empleado_unidad_nostandard))->unique('ID_Puesto');

            // dd($empleado_por_unidad);
            return view('unidades.show', compact('unidad', 'empleado_unidad', 'empleado_por_unidad', 'empleados_curr', 'reales', 'comisionados', 'model_is_empty'));
        } else {
            return abort(403, 'Acción no autorizada.');
        }
    }
}
