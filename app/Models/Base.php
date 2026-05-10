<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Base
 *
 * @property int $ID_Base
 * @property string $Codigo
 * @property string $Complemento_Clave_Presupuestal
 * @property string $Descripcion
 * @property int $USER_CREATED
 * @property int $USER_UPDATED
 * @property \Carbon\Carbon $CREATED_AT
 * @property \Carbon\Carbon $UPDATED_AT
 * @property \Illuminate\Database\Eloquent\Collection $empleados
 */
class Base extends Model
{
    protected $connection = 'mysql2';

    protected $table = 'Base';

    protected $primaryKey = 'ID_Base';

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
        'Codigo',
        'Complemento_Clave_Presupuestal',
        'Descripcion',
        'USER_CREATED',
        'USER_UPDATED',
        'CREATED_AT',
        'UPDATED_AT',
    ];

    public function empleados()
    {
        return $this->hasMany(\App\Models\Empleado::class, 'Base');
    }
}
