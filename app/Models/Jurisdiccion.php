<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Jurisdiccion
 *
 * @property int $ID_Jurisdiccion
 * @property int $ID_Jurisdiccion_Interna
 * @property string $Nombre
 * @property int $Estado
 * @property int $USER_CREATED
 * @property int $USER_UPDATED
 * @property \Carbon\Carbon $CREATED_AT
 * @property \Carbon\Carbon $UPDATED_AT
 * @property \App\Models\Estado $estado
 * @property \Illuminate\Database\Eloquent\Collection $unidads
 */
class Jurisdiccion extends Model
{
    protected $connection = 'mysql2';

    protected $table = 'Jurisdiccion';

    protected $primaryKey = 'ID_Jurisdiccion';

    public $timestamps = false;

    protected $casts = [
        'ID_Jurisdiccion_Interna' => 'int',
        'Estado' => 'int',
        'USER_CREATED' => 'int',
        'USER_UPDATED' => 'int',
    ];

    protected $dates = [
        'CREATED_AT',
        'UPDATED_AT',
    ];

    protected $fillable = [
        'ID_Jurisdiccion_Interna',
        'Nombre',
        'Estado',
        'USER_CREATED',
        'USER_UPDATED',
        'CREATED_AT',
        'UPDATED_AT',
    ];

    public function estado()
    {
        return $this->belongsTo(\App\Models\Estado::class, 'Estado');
    }

    public function unidads()
    {
        return $this->hasMany(\App\Models\Unidad::class, 'Jurisdiccion');
    }
}
