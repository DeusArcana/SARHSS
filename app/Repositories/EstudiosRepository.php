<?php

namespace App\Repositories;

use App\Models\EmpleadoEscolar;
use App\Models\Escolar;
use DB;
use Illuminate\Support\Facades\Auth;

class EstudiosRepository extends EmpleadosRepository implements BaseRepositoryInterface
{
    public function all() {}

    public function find($id, $columns = ['*']) {}

    public function findBy($field, $value, $columns = ['*'])
    {
        try {
            $results = DB::select('CALL `Empl_SSN`.`select_empleado_escolar`(?, ?)', [$field, $value]);

            if (count($results) > 0) {
                return $results;
            } else {
                return [];
            }

        } catch (ModelNotFoundException $e) {
            dd($e->message());
        }
    }

    public function create(array $data)
    {
        DB::transaction(function () use ($data) {
            $escolar_empleado = EmpleadoEscolar::create([
                'Empleado_ID_Empleado' => $data['id_empleado'],
                'Escolar_ID_Escolar' => $data['nivel_escolar'],
                'Institucion' => $data['institucion'],
                'Titulo' => $data['titulo'],
                'Cedula_Estatal' => $data['cedula_estatal'],
                'Cedula_Federal' => $data['cedula_federal'],
                'USER_CREATED' => Auth::user()->id,
                'USER_UPDATED' => Auth::user()->id,
            ]);

            $escolar_empleado->save();
        });
    }

    public function update(array $data, $id)
    {
        DB::transaction(function () use ($data, $id) {
            $escolar = EmpleadoEscolar::find($id);

            $escolar->Escolar_ID_Escolar = $data['nivel_escolar'];
            $escolar->Institucion = $data['institucion'];
            $escolar->Titulo = $data['titulo'];
            $escolar->Cedula_Estatal = $data['cedula_estatal'];
            $escolar->Cedula_Federal = $data['cedula_federal'];
            $escolar->USER_UPDATED = Auth::user()->id;

            $escolar->save();
        });
    }

    public function delete($id)
    {
        $escolares = EmpleadoEscolar::findOrFail($id);
        $escolares->delete();
    }

    public function getEscolar()
    {
        return Escolar::all();
    }

    public function getRequisitosAcademicos($id)
    {
        try {
            $results = DB::select('call Info_SSN.select_requisitos(?)', [$id]);

            if (count($results) > 0) {
                return $results[0];
            } else {
                return null;
            }

        } catch (ModelNotFoundException $e) {
            dd($e->message());
        }
    }
}
