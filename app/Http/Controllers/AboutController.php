<?php

namespace App\Http\Controllers;

use DB;

class AboutController extends Controller
{
    public function getPuestosHomologos()
    {
        $puestos = DB::select('call Info_SSN.select_puesto_homologo()');

        return view('about.about_puestos', compact('puestos'));
    }
}
