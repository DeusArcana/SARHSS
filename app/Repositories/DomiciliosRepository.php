<?php

namespace App\Repositories;

use App\Models\Domicilio;
use DB;
use Illuminate\Support\Facades\Auth;

class DomiciliosRepository extends EmpleadosRepository implements BaseRepositoryInterface
{
    public function all() {}

    public function find($id, $columns = ['*'])
    {
        try {
            $results = DB::select('CALL `Empl_SSN`.`select_domicilio`(?, ?)', [$field, $value]);

            if (count($results) > 0) {
                return $results;
            } else {
                return [];
            }

        } catch (ModelNotFoundException $e) {
            dd($e->message());
        }
    }

    public function findBy($field, $value, $columns = ['*'])
    {
        try {
            $results = DB::select('CALL `Empl_SSN`.`select_domicilio`(?, ?)', [$field, $value]);

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
            $domicilio = new Domicilio([
                'Empleado' => $data['id_empleado'],
                'Domicilio' => $data['domicilio'],
                'Numero_Domicilio' => $data['numero_domicilio'],
                'Codigo_Postal' => $data['asentamiento'],
                'USER_CREATED' => Auth::user()->id,
                'USER_UPDATED' => Auth::user()->id,
            ]);

            $domicilio->save();
        });
    }

    public function update(array $data, $id)
    {
        DB::transaction(function () use ($data, $id) {
            $domicilio = Domicilio::find($id);

            $domicilio->Domicilio = $data['domicilio'];
            $domicilio->Numero_Domicilio = $data['numero_domicilio'];
            $domicilio->Codigo_Postal = $data['asentamiento'];
            $domicilio->USER_UPDATED = Auth::user()->id;

            $domicilio->save();
        });
    }

    public function delete($id)
    {
        $domicilio = Domicilio::findOrFail($id);
        $domicilio->delete();
    }

    public function getDomicilio($field = null, $id = null)
    {
        try {
            $results = DB::select('call Empl_SSN.select_domicilio(?,?)', [$field, $id]);

            if (count($results) > 0) {
                return $results[0];
            } else {
                return null;
            }

        } catch (ModelNotFoundException $e) {
            dd($e->message());
        }
    }

    public function getAsentamientos($cp = null)
    {
        try {
            $results = DB::select('call SEPOMEX.select_asentamiento(?)', [$cp]);

            if (count($results) > 0) {
                return $results;
            } else {
                return null;
            }

        } catch (ModelNotFoundException $e) {
            dd($e->message());
        }
    }
}
