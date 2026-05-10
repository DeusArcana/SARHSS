<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDomiciliosRequest;
use App\Http\Requests\UpdateDomiciliosRequest;
use App\Models\Empleado;
use App\Repositories\BaseRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class DomiciliosController extends Controller
{
    protected $domicilios;

    public function __construct(BaseRepositoryInterface $domicilios)
    {
        $this->domicilios = $domicilios;
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
            $domicilios = $this->domicilios->getEmpleadoDomicilios(1, $id);

            return view('empleados.domicilios.index', compact('domicilios', 'id'));
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

        if (Auth::user()->can('view', $empleado)) {
            return view('empleados.domicilios.create', compact('empleado'));
        } else {
            return abort(403, 'Acción no autorizada.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDomiciliosRequest $request, $id)
    {
        $id = decode('empleados', $id);
        $empleado = Empleado::findOrFail($id);

        if (Auth::user()->can('view', $empleado)) {
            $request->request->add(['id_empleado' => $id]);

            $this->domicilios->create($request->all());

            return redirect(route('empleados.show', encode('empleados', $id)))->with('success', 'Se insertó domicilio correctamente');
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
        $id = decode('domicilios', $id);
        $id_empleado = decode('empleados', $id_empleado);
        $empleado = Empleado::findOrFail($id_empleado);

        if (Auth::user()->can('update', $empleado)) {
            $domicilio = $this->domicilios->getDomicilio(2, $id);
            $asentamientos = $this->domicilios->getAsentamientos($domicilio->Codigo_Postal);

            return view('empleados.domicilios.edit', compact('empleado', 'domicilio', 'asentamientos'));
        } else {
            return abort(403, 'Acción no autorizada.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDomiciliosRequest $request, $id_empleado, $id)
    {
        $id = decode('domicilios', $id);
        $empleado = Empleado::findOrFail($id_empleado);

        if (Auth::user()->can('update', $empleado)) {
            $this->domicilios->update($request->all(), $id);

            return redirect(route('empleados.show', $id_empleado))->with('success', 'Se actualizó domicilio correctamente');
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
        $id = decode('domicilios', $id);
        $empleado = Empleado::findOrFail($id_empleado);

        if (Auth::user()->can('update', $empleado)) {
            $this->domicilios->delete($id);

            return redirect()->back()->with('success', 'Se eliminó domicilio correctamente');
        } else {
            return abort(403, 'Acción no autorizada.');
        }

    }
}
