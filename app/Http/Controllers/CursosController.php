<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCursosRequest;
use App\Http\Requests\UpdateCursosRequest;
use App\Models\Empleado;
use App\Repositories\BaseRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class CursosController extends Controller
{
    protected $cursos;

    public function __construct(BaseRepositoryInterface $cursos)
    {
        $this->cursos = $cursos;
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
            $cursos = $this->cursos->getEmpleadoCurso(1, $id);

            return view('empleados.cursos.index', compact('cursos', 'id'));
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
            $cursos = $this->cursos->getCursos();

            return view('empleados.cursos.create', compact('id', 'cursos'));
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
    public function store(CreateCursosRequest $request, $id)
    {
        $id = decode('empleados', $id);
        $empleado = Empleado::findOrFail($id);

        if (Auth::user()->can('update', $empleado)) {
            $request->request->add(['id_empleado' => $id]);
            $this->cursos->create($request->all());

            return redirect(route('empleados.show', encode('empleados', $id)))->with('success', 'Se inserto el curso correctamente');
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
        $id = decode('cursos', $id);
        $empleado = Empleado::findOrFail(decode('empleados', $id_empleado));

        if (Auth::user()->can('update', $empleado)) {
            $cursos = $this->cursos->getCursos();
            $curso_empleado = $this->cursos->getEmpleadoCurso(2, $id)[0];

            return view('empleados.cursos.edit', compact('id', 'cursos', 'curso_empleado'));
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
    public function update(UpdateCursosRequest $request, $id_empleado, $id)
    {

        $id = decode('cursos', $id);
        $empleado = Empleado::findOrFail(decode('empleados', $id_empleado));

        if (Auth::user()->can('update', $empleado)) {
            $request->request->add(['id_empleado' => $id]);
            $this->cursos->update($request->all(), $id);

            return redirect(route('empleados.show', $id_empleado))->with('success', 'Se actualizo el curso correctamente');
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
        $id = decode('cursos', $id);
        $empleado = Empleado::findOrFail(decode('empleados', $id_empleado));

        if (Auth::user()->can('update', $empleado)) {
            $this->cursos->delete($id);

            return redirect()->back()->with('success', 'Se elimino el curso correctamente');
        } else {
            return abort(403, 'Acción no autorizada.');
        }
    }
}
