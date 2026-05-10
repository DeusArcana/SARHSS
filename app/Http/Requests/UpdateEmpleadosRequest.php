<?php

namespace App\Http\Requests;

use App\Rules\AlphaSpace;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEmpleadosRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // Datos Empleado
            'rfc' => ['required', 'min:12', 'alpha_num'],
            'nombre' => ['required', 'min:3', new AlphaSpace],
            'apellido_paterno' => ['required', 'min:3', new AlphaSpace],
            'apellido_materno' => ['required', 'min:3', new AlphaSpace],
            'sexo' => ['required'],
            'estado_civil' => ['required'],
            'curp' => ['required', 'min:18', 'alpha_num'],
            'fecha_nacimiento' => ['required', 'date:YYYY-MM-DD'],

            'foto' => ['image'],
            'correo_electronico' => ['required', 'email'],

        ];
    }
}
