<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Escolar
 *
 * @property int $ID_Escolar
 * @property string $Nivel_Escolar
 * @property int $USER_CREATED
 * @property int $USER_UPDATED
 * @property \Carbon\Carbon $CREATED_AT
 * @property \Carbon\Carbon $UPDATED_AT
 * @property \Illuminate\Database\Eloquent\Collection $empleados
 */
class Escolar extends Model
{
    protected $table = 'Escolar';

    protected $primaryKey = 'ID_Escolar';

    public $timestamps = false;

    protected $casts = [
        'USER_CREATED' => 'int',
        'USER_UPDATED' => 'int',
    ];

    protected $dates = [
        'CREATED_AT',
        'UPDATED_AT',
    ];

    protected $fillable = [
        'Nivel_Escolar',
        'USER_CREATED',
        'USER_UPDATED',
        'CREATED_AT',
        'UPDATED_AT',
    ];

    public function empleados()
    {
        return $this->belongsToMany(\App\Models\Empleado::class, 'Empleado_Escolar', 'Escolar_ID_Escolar', 'Empleado_ID_Empleado')
            ->withPivot('ID_Empleado_Escolar', 'Institucion', 'Titulo', 'Cedula_Estatal', 'Cedula_Federal', 'USER_CREATED', 'USER_UPDATED', 'CREATED_AT', 'UPDATED_AT');
    }
}
