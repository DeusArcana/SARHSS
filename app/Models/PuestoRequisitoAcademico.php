<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PuestoRequisitoAcademico
 *
 * @property int $ID_Puesto_Requisito_Academico
 * @property int $Puesto
 * @property int $Requisito_Academico
 * @property int $USER_CREATED
 * @property int $USER_UPDATED
 * @property \Carbon\Carbon $CREATED_AT
 * @property \Carbon\Carbon $UPDATED_AT
 * @property \App\Models\Puesto $puesto
 * @property \App\Models\RequisitoAcademico $requisito_academico
 */
class PuestoRequisitoAcademico extends Model
{
    protected $connection = 'mysql2';

    protected $table = 'Puesto_Requisito_Academico';

    protected $primaryKey = 'ID_Puesto_Requisito_Academico';

    public $timestamps = false;

    protected $casts = [
        'Puesto' => 'int',
        'Requisito_Academico' => 'int',
        'USER_CREATED' => 'int',
        'USER_UPDATED' => 'int',
    ];

    protected $dates = [
        'CREATED_AT',
        'UPDATED_AT',
    ];

    protected $fillable = [
        'Puesto',
        'Requisito_Academico',
        'USER_CREATED',
        'USER_UPDATED',
        'CREATED_AT',
        'UPDATED_AT',
    ];

    public function puesto()
    {
        return $this->belongsTo(\App\Models\Puesto::class, 'Puesto');
    }

    public function requisito_academico()
    {
        return $this->belongsTo(\App\Models\RequisitoAcademico::class, 'Requisito_Academico');
    }
}
