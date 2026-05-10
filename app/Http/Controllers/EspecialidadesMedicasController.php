<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEspecialidadesMedicasRequest;
use App\Http\Requests\UpdateEspecialidadesMedicasRequest;
use App\Models\Empleado;
use App\Repositories\BaseRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class EspecialidadesMedicasController extends Controller
{
    protected $especialidades_medicas;

    public function __construct(BaseRepositoryInterface $especialidades_medicas)
    {
        $this->especialidades_medicas = $especialidades_medicas;
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
            $especialidades_medicas = $this->especialidades_medicas->findBy(1, $id);

            return view('empleados.especialidades_medicas.index', compact('especialidades_medicas', 'id'));
        } else {
            return abort(403, 'Acción no autorizada.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $id = decode('empleados', $id);
        $empleado = Empleado::findOrFail($id);

        if (Auth::user()->can('update', $empleado)) {
            $especialidades = $this->especialidades_medicas->getEspecialidadMedica();

            return view('empleados.especialidades_medicas.create', compact('id', 'especialidades'));
        } else {
            return abort(403, 'Acción no autorizada.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateEspecialidadesMedicasRequest $request, $id)
    {
        $id = decode('empleados', $id);
        $empleado = Empleado::findOrFail($id);

        if (Auth::user()->can('update', $empleado)) {
            $request->request->add(['id_empleado' => $id]);
            $this->especialidades_medicas->create($request->all());

            return redirect(route('empleados.show', encode('empleados', $id)))->with('success', 'Se agrego especialidad medica correctamente');
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
    public function edit($id_empleado, $id)
    {
        $id = decode('especialidad_medica', $id);
        $empleado = Empleado::findOrFail(decode('empleados', $id_empleado));

        if (Auth::user()->can('update', $empleado)) {
            $especialidades = $this->especialidades_medicas->getEspecialidadMedica();
            $empleado_especialidad = $this->especialidades_medicas->getEmpleadoEspecialidad(2, $id)[0];

            return view('empleados.especialidades_medicas.edit', compact('id', 'especialidades', 'empleado_especialidad')); //
        } else {
            return abort(403, 'Acción no autorizada.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEspecialidadesMedicasRequest $request, $id_empleado, $id)
    {
        $id = decode('especialidad_medica', $id);
        $empleado = Empleado::findOrFail(decode('empleados', $id_empleado));

        if (Auth::user()->can('update', $empleado)) {
            $request->request->add(['id_empleado' => $id]);
            $this->especialidades_medicas->update($request->all(), $id);

            return redirect(route('empleados.show', $id_empleado))->with('success', 'Se actualizo especialidad medica correctamente');
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
    public function destroy($id_empleado, $id)
    {
        $id = decode('especialidad_medica', $id);
        $empleado = Empleado::findOrFail(decode('empleados', $id_empleado));

        if (Auth::user()->can('update', $empleado)) {
            $this->especialidades_medicas->delete($id);

            return redirect()->back()->with('success', 'Se elimino especialidad medica correctamente');
        } else {
            return abort(403, 'Acción no autorizada.');
        }
    }
}
