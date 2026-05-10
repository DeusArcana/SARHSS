<?php

namespace App\Repositories;

use App\Models\EmpleadoUnidad;
use App\Models\Unidad;
use DB;

/**
 * UnidadesRepository
 */
class UnidadesRepository implements BaseRepositoryInterface
{
    public function all()
    {
        return DB::select(
            'CALL `Info_SSN`.`select_unidades_medicas`(?, ?)',
            [0, 0]
        );
    }

    public function find($id, $columns = ['*'])
    {
        return Unidad::findOrFail($id);
    }

    public function findBy($field, $value, $columns = ['*'])
    {
        try {
            Unidad::findOrFail($value);
            if ($field == 1) {
                return collect(
                    DB::select(
                        'CALL `Info_SSN`.`select_unidades_medicas`(?, ?)',
                        [$field, $value]
                    )
                );
            } else {
                return collect(
                    DB::select(
                        'CALL `Info_SSN`.`select_unidades_medicas`(?, ?)',
                        [$field, $value]
                    )
                )->shift();
            }

        } catch (ModelNotFoundException $e) {

        }

    }

    public function create(array $request) {}

    public function update(array $data, $id) {}

    public function delete($id) {}

    public function getEmpleadoTipoUnidad($filter, $value)
    {
        return collect(
            DB::select(
                'CALL `Info_SSN`.`select_empleado_tipo_unidad`(?, ?)',
                [$filter, $value]
            )
        )->map(function ($item, $key) {
            return collect($item)
                ->except(['Tipo_Unidad', 'ID_Empleado_Tipo_Unidad']);
        })->toArray();
    }

    public function getEmpleadoUnidad($filter, $value)
    {
        if ($filter) {
            return collect(DB::select(
                'CALL `Empl_SSN`.`select_empleado_unidad`(?, ?)',
                [1, $value]
            )
            )->map(function ($item, $key) {
                return collect($item)
                        // -> prepend((int)($item -> ID_Puesto . $item -> ID_Servicio . "666"), "ID_Servicio_Puesto")
                    ->prepend(0, 'Cantidad');
            })->toArray();
        } else {
            return collect(DB::select(
                'CALL `Empl_SSN`.`select_empleado_unidad`(?, ?)',
                [0, $value]
            )
            )->map(function ($item, $key) {
                return collect($item)
                    ->prepend(0, 'Cantidad');
            })->toArray();
        }

    }

    public function getJurisdiccion($id)
    {
        try {
            $results = collect(DB::select(
                'CALL `Info_SSN`.`select_jurisdiccion`(?)',
                [$id]));

            if (count($results) > 0) {
                return $results->shift();
            } else {
                return null;
            }

        } catch (ModelNotFoundException $e) {
            dd($e->message());
        }

    }

    public function getUnidadUser($id)
    {
        return EmpleadoUnidad::where('Empleado_ID_Empleado', $id)->firstOrFail()->toArray();
    }

    public function getCantidadPuesto($value)
    {
        return collect(
            DB::select(
                'CALL `Info_SSN`.`select_cantidad_puesto`(?)',
                [$value]
            )
        )->map(function ($item, $key) {
            return collect($item)
                ->except(['Tipo_Unidad', 'ID_Empleado_Tipo_Unidad']);
        })->toArray();
    }
}
