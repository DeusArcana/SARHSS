<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEstudiosRequest;
use App\Http\Requests\UpdateEstudiosRequest;
use App\Models\Empleado;
use App\Repositories\BaseRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class EstudiosController extends Controller
{
    protected $estudios;

    public function __construct(BaseRepositoryInterface $estudios)
    {
        $this->estudios = $estudios;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $id = decode('empleados', $id);
        $empleado = Empleado::findOrFail($id);

        if (Auth::user()->can('view', $empleado)) {
            $estudios = $this->estudios->findBy(1, $id);

            return view('empleados.estudios.index', compact('estudios', 'id'));
        } else {
            return abort(403, 'Acción no autorizada.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $id = decode('empleados', $id);
        $empleado = Empleado::findOrFail($id);

        if (Auth::user()->can('update', $empleado)) {
            $escolares = $this->estudios->getEscolar();
            $empleado_puesto = $this->estudios->getEmpleadoPuesto($id);
            $requisitos = $this->estudios->getRequisitosAcademicos($empleado_puesto->ID_Puesto);

            return view('empleados.estudios.create', compact('empleado_puesto', 'escolares', 'requisitos'));
        } else {
            return abort(403, 'Acción no autorizada.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Requests\CreateEstudiosRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateEstudiosRequest $request, $id)
    {
        $id = decode('empleados', $id);
        $empleado = Empleado::findOrFail($id);

        if (Auth::user()->can('update', $empleado)) {
            // Agregamos el ID del empleado al Request para la relación
            // entre empleado y estudio
            $request->request->add(['id_empleado' => $id]);
            $this->estudios->create($request->all());

            return redirect(route('empleados.show', encode('empleados', $id)))->with('success', 'Se inserto estudio correctamente');
        } else {
            return abort(403, 'Acción no autorizada.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id_empleado
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_empleado, $id)
    {
        $id = decode('estudios', $id);
        $id_empleado = decode('empleados', $id_empleado);
        $empleado = Empleado::findOrFail($id_empleado);

        if (Auth::user()->can('update', $empleado)) {
            $escolares = $this->estudios->getEscolar();
            $empleado_escolar = $this->estudios->getEmpleadoEscolar(2, $id)[0];

            return view('empleados.estudios.edit', compact('escolares', 'empleado_escolar'));
        } else {
            return abort(403, 'Acción no autorizada.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\UpdateEstudiosRequest  $request
     * @param  int  $id_empleado
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEstudiosRequest $request, $id_empleado, $id)
    {
        $id = decode('estudios', $id);
        $id_empleado = decode('empleados', $id_empleado);
        $empleado = Empleado::findOrFail($id_empleado);

        if (Auth::user()->can('update', $empleado)) {
            $this->estudios->update($request->all(), $id);

            return redirect(route('empleados.show', $id_empleado))->with('success', 'Se actualizo grado de estudio correctamente');
        } else {
            return abort(403, 'Acción no autorizada.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  int  $id_empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_empleado, $id)
    {
        $id = decode('estudios', $id);
        $id_empleado = decode('empleados', $id_empleado);
        $empleado = Empleado::findOrFail($id_empleado);

        if (Auth::user()->can('update', $empleado)) {
            $this->estudios->delete($id);

            return redirect()->back()->with('success', 'Se elimino grado de estudio correctamente');
        } else {
            return abort(403, 'Acción no autorizada.');
        }
    }
}
