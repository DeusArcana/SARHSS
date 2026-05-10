<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use DB;

class SEPOMEXController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'BLAH';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($codigo_postal)
    {
        $asentamientos = DB::select('call SEPOMEX.select_asentamiento(?)', [$codigo_postal]);

        return response()->json($asentamientos);
    }
}
