<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RamaPuesto
 *
 * @property int $ID_Rama_Puesto
 * @property int $Rama_ID_Rama
 * @property int $Puesto_ID_Puesto
 * @property int $USER_CREATED
 * @property int $USER_UPDATED
 * @property \Carbon\Carbon $CREATED_AT
 * @property \Carbon\Carbon $UPDATED_AT
 * @property \App\Models\Puesto $puesto
 * @property \App\Models\Rama $rama
 */
class RamaPuesto extends Model
{
    protected $connection = 'mysql2';

    protected $table = 'Rama_Puesto';

    protected $primaryKey = 'ID_Rama_Puesto';

    public $timestamps = false;

    protected $casts = [
        'Rama_ID_Rama' => 'int',
        'Puesto_ID_Puesto' => 'int',
        'USER_CREATED' => 'int',
        'USER_UPDATED' => 'int',
    ];

    protected $dates = [
        'CREATED_AT',
        'UPDATED_AT',
    ];

    protected $fillable = [
        'Rama_ID_Rama',
        'Puesto_ID_Puesto',
        'USER_CREATED',
        'USER_UPDATED',
        'CREATED_AT',
        'UPDATED_AT',
    ];

    public function puesto()
    {
        return $this->belongsTo(\App\Models\Puesto::class, 'Puesto_ID_Puesto');
    }

    public function rama()
    {
        return $this->belongsTo(\App\Models\Rama::class, 'Rama_ID_Rama');
    }
}
