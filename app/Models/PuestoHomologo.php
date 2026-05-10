<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PuestoHomologo
 *
 * @property int $ID_Puesto_Homologo
 * @property int $Puesto
 * @property int $Homologo
 * @property int $USER_CREATED
 * @property int $USER_UPDATED
 * @property \Carbon\Carbon $CREATED_AT
 * @property \Carbon\Carbon $UPDATED_AT
 * @property \App\Models\Puesto $puesto
 */
class PuestoHomologo extends Model
{
    protected $connection = 'mysql2';

    protected $table = 'Puesto_Homologo';

    protected $primaryKey = 'ID_Puesto_Homologo';

    public $timestamps = false;

    protected $casts = [
        'Puesto' => 'int',
        'Homologo' => 'int',
        'USER_CREATED' => 'int',
        'USER_UPDATED' => 'int',
    ];

    protected $dates = [
        'CREATED_AT',
        'UPDATED_AT',
    ];

    protected $fillable = [
        'Puesto',
        'Homologo',
        'USER_CREATED',
        'USER_UPDATED',
        'CREATED_AT',
        'UPDATED_AT',
    ];

    public function puesto()
    {
        return $this->belongsTo(\App\Models\Puesto::class, 'Puesto');
    }
}
