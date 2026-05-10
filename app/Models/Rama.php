<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Rama
 *
 * @property int $ID_Rama
 * @property string $Categoria
 * @property int $USER_CREATED
 * @property int $USER_UPDATED
 * @property \Carbon\Carbon $CREATED_AT
 * @property \Carbon\Carbon $UPDATED_AT
 * @property \Illuminate\Database\Eloquent\Collection $puestos
 */
class Rama extends Model
{
    protected $connection = 'mysql2';

    protected $table = 'Rama';

    protected $primaryKey = 'ID_Rama';

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
        'Categoria',
        'USER_CREATED',
        'USER_UPDATED',
        'CREATED_AT',
        'UPDATED_AT',
    ];

    public function puestos()
    {
        return $this->belongsToMany(\App\Models\Puesto::class, 'Rama_Puesto', 'Rama_ID_Rama', 'Puesto_ID_Puesto')
            ->withPivot('ID_Rama_Puesto', 'USER_CREATED', 'USER_UPDATED', 'CREATED_AT', 'UPDATED_AT');
    }
}
