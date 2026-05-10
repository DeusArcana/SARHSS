<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Curso;

class CursosController extends Controller
{
    public function getCurso($id)
    {
        $curso = collect(Curso::Where('ID_Curso', $id)->get(['Nombre', 'Institucion']))->shift();

        return response()->json($curso);
    }//
}
