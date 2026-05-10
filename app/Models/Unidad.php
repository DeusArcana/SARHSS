<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Unidad
 *
 * @property int $ID_Unidad
 * @property string $CLUES
 * @property int $Jurisdiccion
 * @property int $Tipo_Unidad
 * @property int $Subtipo_Unidad
 * @property int $Zona_Economica
 * @property string $Nombre
 * @property string $Domicilio
 * @property string $Numero_Domicilio
 * @property int $Codigo_Postal
 * @property string $Operacion
 * @property string $Observaciones
 * @property int $USER_CREATED
 * @property int $USER_UPDATED
 * @property \Carbon\Carbon $CREATED_AT
 * @property \Carbon\Carbon $UPDATED_AT
 * @property \App\Models\Jurisdiccion $jurisdiccion
 * @property \App\Models\SEPOMEX $s_e_p_o_m_e_x
 * @property \App\Models\SubtipoUnidad $subtipo_unidad
 * @property \App\Models\TipoUnidad $tipo_unidad
 * @property \Illuminate\Database\Eloquent\Collection $empleados
 */
class Unidad extends Model
{
    protected $connection = 'mysql2';

    protected $table = 'Unidad';

    protected $primaryKey = 'ID_Unidad';

    public $timestamps = false;

    protected $casts = [
        'Jurisdiccion' => 'int',
        'Tipo_Unidad' => 'int',
        'Subtipo_Unidad' => 'int',
        'Zona_Economica' => 'int',
        'Codigo_Postal' => 'int',
        'USER_CREATED' => 'int',
        'USER_UPDATED' => 'int',
    ];

    protected $dates = [
        'CREATED_AT',
        'UPDATED_AT',
    ];

    protected $fillable = [
        'CLUES',
        'Jurisdiccion',
        'Tipo_Unidad',
        'Subtipo_Unidad',
        'Zona_Economica',
        'Nombre',
        'Domicilio',
        'Numero_Domicilio',
        'Codigo_Postal',
        'Operacion',
        'Observaciones',
        'USER_CREATED',
        'USER_UPDATED',
        'CREATED_AT',
        'UPDATED_AT',
    ];

    public function jurisdiccion()
    {
        return $this->belongsTo(\App\Models\Jurisdiccion::class, 'Jurisdiccion');
    }

    public function s_e_p_o_m_e_x()
    {
        return $this->belongsTo(\App\Models\SEPOMEX::class, 'Codigo_Postal');
    }

    public function subtipo_unidad()
    {
        return $this->belongsTo(\App\Models\SubtipoUnidad::class, 'Subtipo_Unidad');
    }

    public function tipo_unidad()
    {
        return $this->belongsTo(\App\Models\TipoUnidad::class, 'Tipo_Unidad');
    }

    public function empleados()
    {
        return $this->belongsToMany(\App\Models\Empleado::class, 'Empl_SSN.Empleado_Unidad', 'Unidad_Fisica', 'Empleado_ID_Empleado')
            ->withPivot('ID_Empleado_Unidad', 'Unidad_Adscripcion', 'Estado_Adscripcion', 'Numero_Oficio', 'USER_CREATED', 'USER_UPDATED', 'CREATED_AT', 'UPDATED_AT');
    }
}
