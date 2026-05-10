<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SEPOMEX
 *
 * @property int $id
 * @property int $idEstado
 * @property string $estado
 * @property int $idMunicipio
 * @property string $municipio
 * @property string $ciudad
 * @property string $zona
 * @property int $cp
 * @property string $asentamiento
 * @property string $tipo
 * @property \Illuminate\Database\Eloquent\Collection $domicilios
 * @property \Illuminate\Database\Eloquent\Collection $unidads
 */
class SEPOMEX extends Model
{
    protected $connection = 'mysql4';

    protected $table = 'SEPOMEX';

    public $timestamps = false;

    protected $casts = [
        'idEstado' => 'int',
        'idMunicipio' => 'int',
        'cp' => 'int',
    ];

    protected $fillable = [
        'idEstado',
        'estado',
        'idMunicipio',
        'municipio',
        'ciudad',
        'zona',
        'cp',
        'asentamiento',
        'tipo',
    ];

    public function domicilios()
    {
        return $this->hasMany(\App\Models\Domicilio::class, 'Codigo_Postal');
    }

    public function unidads()
    {
        return $this->hasMany(\App\Models\Unidad::class, 'Codigo_Postal');
    }
}
