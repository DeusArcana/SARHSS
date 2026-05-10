<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Telefono
 *
 * @property int $ID_Telefono
 * @property string $Numero_Telefono
 * @property string $Tipo
 * @property int $Empleado
 * @property int $USER_CREATED
 * @property int $USER_UPDATED
 * @property \Carbon\Carbon $CREATED_AT
 * @property \Carbon\Carbon $UPDATED_AT
 * @property \App\Models\Empleado $empleado
 */
class Telefono extends Model
{
    protected $table = 'Telefono';

    protected $primaryKey = 'ID_Telefono';

    public $timestamps = false;

    protected $casts = [
        'Empleado' => 'int',
        'USER_CREATED' => 'int',
        'USER_UPDATED' => 'int',
    ];

    protected $dates = [
        'CREATED_AT',
        'UPDATED_AT',
    ];

    protected $fillable = [
        'Numero_Telefono',
        'Tipo',
        'Empleado',
        'USER_CREATED',
        'USER_UPDATED',
        'CREATED_AT',
        'UPDATED_AT',
    ];

    public function empleado()
    {
        return $this->belongsTo(\App\Models\Empleado::class, 'Empleado');
    }
}
