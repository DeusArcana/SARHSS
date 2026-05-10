<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEmpleadosRequest;
use App\Http\Requests\UpdateEmpleadosRequest;
use App\Models\Base;
use App\Models\EstadoCivil;
use App\Models\Servicio;
use App\Repositories\BaseRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class EmpleadosController extends Controller
{
    /**
     * Implementación del Repositorio
     *
     * @var empleado
     */
    protected $empleado;

    /**
     * Create a new controller instance.
     *
     * @param  BaseRepositoryInterface  $empleado  Interface to handle business logic.
     * @return void
     */
    public function __construct(BaseRepositoryInterface $empleado)
    {
        $this->empleado = $empleado;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->hasRoles(['local'])) {
            return abort(403, 'Acción no autorizada.');
        }

        if (Auth::user()->hasRoles(['juris'])) {
            $empleados = $this->empleado->findBy('Jurisdiccion', Auth::user()->Jurisdiccion, null);
        } else {
            $empleados = $this->empleado->all();
        }

        return view('empleados.index', compact('empleados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $servicios = Servicio::all();
        $bases = Base::all();
        $estados_civiles = EstadoCivil::all();

        return view('empleados.create', compact('servicios', 'bases', 'estados_civiles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\CreateEmpleadosRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateEmpleadosRequest $request)
    {
        $id_empleado = $this->empleado->create($request->all());

        return redirect(route('empleados.show', encode('empleados', $id_empleado)))->with('success', 'Se inserto correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = decode('empleados', $id);
        $empleado_simple = $this->empleado->findBy('ID', $id);

        if (Auth::user()->can('view', $empleado_simple)) {
            $empleado = $this->empleado->getEmpleadoPuesto($id);
            $domicilios = $this->empleado->getEmpleadoDomicilios(1, $id);
            $escolares = $this->empleado->getEmpleadoEscolar(1, $id);
            $turnos = $this->empleado->getEmpleadoTurnos($id);
            $cursos = $this->empleado->getEmpleadoCurso(1, $id);
            $especialidades = $this->empleado->getEmpleadoEspecialidadMedica(1, $id);

            $jornada_total = 0;

            if (empty($turnos)) {
                $periodo = 'Sin Turno';
            } else {
                $periodo = $turnos[0]->Periodo;
            }

            foreach ($turnos as $turno) {
                $jornada_total += $turno->Horas_Jornada;
            }

            return view('empleados.show', compact('empleado', 'domicilios', 'escolares', 'turnos', 'jornada_total', 'periodo', 'cursos', 'especialidades'));
        } else {
            return abort(403, 'Acción no autorizada.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = decode('empleados', $id);
        $empleado_simple = $this->empleado->findBy('ID', $id);

        if (Auth::user()->can('update', $empleado_simple)) {
            $servicios = Servicio::all();
            $bases = Base::all();
            $estados_civiles = EstadoCivil::all();

            $empleado = $this->empleado->find($id);

            return view('empleados.edit', compact('empleado', 'bases', 'estados_civiles'));
        } else {
            return abort(403, 'Acción no autorizada.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\UpdateEmpleadosRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmpleadosRequest $request, $id)
    {
        $id = decode('empleados', $id);
        $empleado_simple = $this->empleado->findBy('ID', $id);

        if (Auth::user()->can('update', $empleado_simple)) {
            $this->empleado->update($request->all(), $id);

            return redirect(route('empleados.index'))->with('success', 'Se actualizo correctamente');
        } else {
            return abort(403, 'Acción no autorizada.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = decode('empleados', $id);
        $empleado_simple = $this->empleado->findBy('ID', $id);

        if (Auth::user()->can('delete', $empleado_simple)) {
            $this->empleado->delete($id);

            return redirect(route('empleados.index'))->with('success', 'Se elimino correctamente');
        } else {
            return abort(403,  'Acción no autorizada.');
        }
    }
}
