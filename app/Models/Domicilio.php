<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Domicilio
 *
 * @property int $ID_Domicilio
 * @property int $Empleado
 * @property string $Domicilio
 * @property string $Numero_Domicilio
 * @property int $Codigo_Postal
 * @property int $USER_CREATED
 * @property int $USER_UPDATED
 * @property \Carbon\Carbon $CREATED_AT
 * @property \Carbon\Carbon $UPDATED_AT
 * @property \App\Models\Empleado $empleado
 * @property \App\Models\SEPOMEX $s_e_p_o_m_e_x
 */
class Domicilio extends Model
{
    protected $table = 'Domicilio';

    protected $primaryKey = 'ID_Domicilio';

    public $timestamps = false;

    protected $casts = [
        'Empleado' => 'int',
        'Codigo_Postal' => 'int',
        'USER_CREATED' => 'int',
        'USER_UPDATED' => 'int',
    ];

    protected $dates = [
        'CREATED_AT',
        'UPDATED_AT',
    ];

    protected $fillable = [
        'Empleado',
        'Domicilio',
        'Numero_Domicilio',
        'Codigo_Postal',
        'USER_CREATED',
        'USER_UPDATED',
        'CREATED_AT',
        'UPDATED_AT',
    ];

    public function empleado()
    {
        return $this->belongsTo(\App\Models\Empleado::class, 'Empleado');
    }

    public function s_e_p_o_m_e_x()
    {
        return $this->belongsTo(\App\Models\SEPOMEX::class, 'Codigo_Postal');
    }
}
