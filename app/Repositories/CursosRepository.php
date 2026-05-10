<?php

namespace App\Repositories;

use App\Models\Curso;
use App\Models\EmpleadoCurso;
use DB;
use Illuminate\Support\Facades\Auth;

class CursosRepository extends EmpleadosRepository implements BaseRepositoryInterface
{
    public function all() {}

    public function find($id, $columns = ['*']) {}

    public function findBy($field, $value, $columns = ['*'])
    {
        try {
            $results = DB::select('CALL `Empl_SSN`.`select_empleado_curso`(?, ?)', [$field, $value]);

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

            $id_curso = null;

            if ($data['curso'] == null) {
                $curso = Curso::create([
                    'Nombre' => $data['nombre'],
                    'Institucion' => $data['institucion'],
                    'USER_CREATED' => Auth::user()->id,
                    'USER_UPDATED' => Auth::user()->id,
                ]);

                $curso->save();
                $id_curso = $curso->ID_Curso;
            } else {
                $id_curso = $data['curso'];
            }

            $curso_empleado = EmpleadoCurso::create([
                'Empleado_ID_Empleado' => $data['id_empleado'],
                'Curso_ID_Curso' => $id_curso,
                'USER_CREATED' => Auth::user()->id,
                'USER_UPDATED' => Auth::user()->id,
            ]);

            $curso_empleado->save();
        });
    }

    public function update(array $data, $id)
    {
        DB::transaction(function () use ($data, $id) {
            $curso_empleado = EmpleadoCurso::find($id);

            if ($data['curso'] == null) {
                $curso = Curso::create([
                    'Nombre' => $data['nombre'],
                    'Institucion' => $data['institucion'],
                    'USER_CREATED' => Auth::user()->id,
                    'USER_UPDATED' => Auth::user()->id,
                ]);

                $curso->save();

                $id_curso = $curso->ID_Curso;
                $curso_empleado->Curso_ID_Curso = $id_curso;
                $curso_empleado->USER_UPDATED = Auth::user()->id;
            } else {
                $curso_empleado->Curso_ID_Curso = $data['curso'];
            }

            $curso_empleado->save();
        });
    }

    public function delete($id)
    {
        $escolares = EmpleadoCurso::findOrFail($id);
        $escolares->delete();
    }

    public function getCursos()
    {
        return Curso::all();
    }
}
