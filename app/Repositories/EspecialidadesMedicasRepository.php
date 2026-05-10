<?php

namespace App\Repositories;

use App\Models\EmpleadoEspecialidadMedica;
use App\Models\EspecialidadMedica;
use DB;
use Illuminate\Support\Facades\Auth;

class EspecialidadesMedicasRepository extends EmpleadosRepository implements BaseRepositoryInterface
{
    public function all() {}

    public function find($id, $columns = ['*']) {}

    public function findBy($field, $value, $columns = ['*'])
    {
        try {
            $results = DB::select('CALL `Empl_SSN`.`select_empleado_especialidad_medica`(?, ?)', [$field, $value]);

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

            $especialidad_empleado = EmpleadoEspecialidadMedica::create([
                'Empleado_ID_Empleado' => $data['id_empleado'],
                'Especialidad_Medica_ID_Especialidad' => $data['especialidad'],
                'USER_CREATED' => Auth::user()->id,
                'USER_UPDATED' => Auth::user()->id,
            ]);

            $especialidad_empleado->save();
        });
    }

    public function update(array $data, $id)
    {
        DB::transaction(function () use ($data, $id) {
            $especialidad_empleado = EmpleadoEspecialidadMedica::find($id);

            $especialidad_empleado->Especialidad_Medica_ID_Especialidad = $data['especialidad'];

            $especialidad_empleado->save();
        });
    }

    public function delete($id)
    {

        $escolares = EmpleadoEspecialidadMedica::findOrFail($id);

        $escolares->delete();
    }

    public function getEspecialidadMedica()
    {

        return EspecialidadMedica::all();
    }
}
