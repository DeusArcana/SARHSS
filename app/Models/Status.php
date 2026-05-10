<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Status
 *
 * @property int $ID_Status
 * @property string $Descripcion
 * @property \Illuminate\Database\Eloquent\Collection $empleados
 */
class Status extends Model
{
    protected $table = 'Status';

    protected $primaryKey = 'ID_Status';

    public $timestamps = false;

    protected $fillable = [
        'Descripcion',
    ];

    public function empleados()
    {
        return $this->hasMany(\App\Models\Empleado::class, 'Status');
    }
}
