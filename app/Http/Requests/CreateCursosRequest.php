<?php

namespace App\Http\Requests;

use App\Rules\AlphaSpace;
use Illuminate\Foundation\Http\FormRequest;

class CreateCursosRequest extends FormRequest
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
            'nombre' => ['required', 'min:3', new AlphaSpace],
            'institucion' => ['required', 'min:3'],
        ];
    }
}
