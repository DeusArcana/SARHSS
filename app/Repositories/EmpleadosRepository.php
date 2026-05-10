<?php

namespace App\Repositories;

use App\Models\Domicilio;
use App\Models\Empleado;
use App\Models\EmpleadoServicioPuesto;
use App\Models\EmpleadoTurno;
use App\Models\EmpleadoUnidad;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Image;

/**
 * EmpleadosRepository
 */
class EmpleadosRepository implements BaseRepositoryInterface
{
    public function all()
    {
        return Empleado::Where('Status', [1, 2, 4])->with('Status')->get();
    }

    public function find($id, $columns = ['*'])
    {
        try {
            $results = DB::select('CALL `Empl_SSN`.`select_empleado`(?)', [$id]);

            if (count($results) > 0) {
                return $results[0];
            } else {
                return null;
            }

        } catch (ModelNotFoundException $e) {
            dd($e);
        }
    }

    public function findBy($field, $value, $columns = ['*'])
    {
        try {
            if ($field == 'ID') {
                return Empleado::findOrFail($value);
            } elseif ($field == 'Jurisdiccion') {
                $results = DB::select('CALL `Empl_SSN`.`select_empleado_jurisdiccion`(?)', [$value]);

                if (count($results) > 0) {
                    return $results;
                } else {
                    return null;
                }
            }
        } catch (ModelNotFoundException $e) {
            dd($e);
        }
    }

    public function create(array $data)
    {
        $id_empleado = DB::transaction(function () use ($data) {
            $empleado = new Empleado([
                'RFC' => $data['rfc'],
                'Nombre' => $data['nombre'],
                'Apellido_Paterno' => $data['apellido_paterno'],
                'Apellido_Materno' => $data['apellido_materno'],
                'Base' => $data['base'],
                'Sexo' => $data['sexo'],
                'Estado_Civil' => $data['estado_civil'],
                'CURP' => $data['curp'],
                'Fecha_Nacimiento' => $data['fecha_nacimiento'],
                'Lugar_Nacimiento' => $data['lugar_nacimiento'],
                'Correo_Electronico' => $data['correo_electronico'],
                'Clave_Presupuestal' => $data['clave_presupuestal_base'].
                                            $data['clave_presupuestal_codigo'].
                                            $data['clave_presupuestal_unico'],
                'USER_CREATED' => Auth::user()->id,
                'USER_UPDATED' => Auth::user()->id,
            ]);

            $empleado->save();

            $id_empleado = $empleado->ID_Empleado;

            if (! array_key_exists('puesto_alternativo', $data)) {
                $empleado_servicio_puesto = new EmpleadoServicioPuesto([
                    'Empleado' => $id_empleado,
                    'Estandar' => 1,
                    'Servicio_Puesto' => $data['servicio_puesto'],
                    'USER_CREATED' => Auth::user()->id,
                    'USER_UPDATED' => Auth::user()->id,
                ]);
            } else {
                $empleado_servicio_puesto = new EmpleadoServicioPuesto([
                    'Empleado' => $id_empleado,
                    'Estandar' => 0,
                    'Servicio' => $data['servicio'],
                    'Puesto' => $data['puesto_alternativo'],
                    'USER_CREATED' => Auth::user()->id,
                    'USER_UPDATED' => Auth::user()->id,
                ]);
            }

            $empleado_servicio_puesto->save();

            if (! array_key_exists('unidad_fisica', $data)) {
                $unidad = new EmpleadoUnidad([
                    'Empleado_ID_Empleado' => $id_empleado,
                    'Unidad_Fisica' => $data['unidad_adscrita'],
                    'Unidad_Adscripcion' => $data['unidad_adscrita'],
                    'Estado_Adscripcion' => 'REAL',
                    'USER_CREATED' => Auth::user()->id,
                    'USER_UPDATED' => Auth::user()->id,
                ]);
            } else {
                $unidad = new EmpleadoUnidad([
                    'Empleado_ID_Empleado' => $id_empleado,
                    'Unidad_Fisica' => $data['unidad_adscrita'],
                    'Unidad_Adscripcion' => $data['unidad_fisica'],
                    'Estado_Adscripcion' => 'COMISIONADO',
                    'Numero_Oficio' => $data['numero_oficio'],
                    'USER_CREATED' => Auth::user()->id,
                    'USER_UPDATED' => Auth::user()->id,
                ]);
            }

            $domicilio = new Domicilio([
                'Empleado' => $id_empleado,
                'Domicilio' => $data['domicilio'],
                'Numero_Domicilio' => $data['numero_domicilio'],
                'Codigo_Postal' => $data['asentamiento'],
                'USER_CREATED' => Auth::user()->id,
                'USER_UPDATED' => Auth::user()->id,
            ]);

            $turno = new EmpleadoTurno([
                'Empleado_ID_Empleado' => $id_empleado,
                'Turno_ID_Turno' => $data['turno'],
                'Fecha_Inicio' => $data['fecha_turno'],
                'USER_CREATED' => Auth::user()->id,
                'USER_UPDATED' => Auth::user()->id,
            ]);

            $turno->save();

            if (Input::file('foto')) {
                $image = $data['foto'];
                $filename = $id_empleado.'.'.$image->getClientOriginalExtension();
                $image_resize = Image::make($image->getRealPath());
                $image_resize->resize(200, 300);
                $image_resize->save(storage_path('app/public/fotos/'.$filename));
                $empleado->Foto = $filename;
                $empleado->save();
            }

            $unidad->save();
            $domicilio->save();

            return $id_empleado;
        });

        return $id_empleado;
    }

    public function update(array $data, $id)
    {
        DB::transaction(function () use ($data, $id) {
            $empleado = Empleado::find($id);

            $empleado->RFC = $data['rfc'];
            $empleado->Nombre = $data['nombre'];
            $empleado->CURP = $data['curp'];
            $empleado->Apellido_Paterno = $data['apellido_paterno'];
            $empleado->Apellido_Materno = $data['apellido_materno'];
            $empleado->Fecha_Nacimiento = $data['fecha_nacimiento'];
            $empleado->Lugar_Nacimiento = $data['lugar_nacimiento'];
            $empleado->Sexo = $data['sexo'];
            $empleado->Estado_Civil = $data['estado_civil'];
            $empleado->Correo_Electronico = $data['correo_electronico'];
            $empleado->USER_UPDATED = Auth::user()->id;

            $id_empleado = $empleado->ID_Empleado;

            if (Input::file('foto')) {
                $image = $data['foto'];
                $filename = $id_empleado.'.'.$image->getClientOriginalExtension();

                $image_resize = Image::make($image->getRealPath());
                $image_resize->resize(200, 300);
                $image_resize->save(storage_path('app/public/fotos/'.$filename));
                $empleado->Foto = $filename;

                $empleado->save();
            }

            $empleado->save();
        });
    }

    public function delete($id)
    {
        $empleado = Empleado::findOrFail($id);
        $empleado->Status = 0;
        $empleado->USER_UPDATED = Auth::user()->id;
        $empleado->saveOrFail();
    }

    public function getEmpleadoPuesto($id)
    {
        try {
            $results = DB::select('CALL `Empl_SSN`.`select_empleado_puesto`(?)', [$id]);

            if (count($results) > 0) {
                return $results[0];
            } else {
                return null;
            }

        } catch (ModelNotFoundException $e) {
            dd($e->message());
        }
    }

    public function getEmpleadoUnidad($filter, $value)
    {
        try {
            $results = DB::select('CALL `Empl_SSN`.`select_empleado_unidad`(?, ?)', [$filter, $value]);

            if (count($results) > 0) {
                return $results[0];
            } else {
                return null;
            }

        } catch (ModelNotFoundException $e) {
            dd($e->message());
        }
    }

    public function getEmpleadoDomicilios($field, $value)
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

    public function getEmpleadoEscolar($field, $value)
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

    public function getEmpleadoCurso($field, $value)
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

    public function getEmpleadoEspecialidad($field, $value)
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

    public function getEmpleadoEspecialidadMedica($field, $value)
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

    public function getEmpleadoTurnos($value)
    {
        try {
            $results = DB::select('CALL `Empl_SSN`.`select_empleado_turnos`(?)', [$value]);

            if (count($results) > 0) {
                return $results;
            } else {
                return [];
            }

        } catch (ModelNotFoundException $e) {
            dd($e->message());
        }
    }
}
