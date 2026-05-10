<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RequisitoAcademico
 *
 * @property int $ID_Requisito_Academico
 * @property string $Descripcion
 * @property int $USER_CREATED
 * @property int $USER_UPDATED
 * @property \Carbon\Carbon $CREATED_AT
 * @property \Carbon\Carbon $UPDATED_AT
 * @property \Illuminate\Database\Eloquent\Collection $puestos
 */
class RequisitoAcademico extends Model
{
    protected $connection = 'mysql2';

    protected $table = 'Requisito_Academico';

    protected $primaryKey = 'ID_Requisito_Academico';

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
        'Descripcion',
        'USER_CREATED',
        'USER_UPDATED',
        'CREATED_AT',
        'UPDATED_AT',
    ];

    public function puestos()
    {
        return $this->belongsToMany(\App\Models\Puesto::class, 'Puesto_Requisito_Academico', 'Requisito_Academico', 'Puesto')
            ->withPivot('ID_Puesto_Requisito_Academico', 'USER_CREATED', 'USER_UPDATED', 'CREATED_AT', 'UPDATED_AT');
    }
}
