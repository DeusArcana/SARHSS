<?php

namespace App\Http\Controllers;

use Date;
use Illuminate\Http\Request;
use PDF;

class MovimientosUnidadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('movimientos_unidad.index'); //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('movimientos_unidad.create'); //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function generarDocumento()
    {
        $fecha = Date::now()->format('l j F Y H:i:s');

        $data = [$fecha];
        $pdf = PDF::loadView('oficioDePresentacion');

        $footerHtml = view()->make('footer')->render();

        $pdf->setOption('margin-left', 25);
        $pdf->setOption('margin-right', 25);
        $pdf->setOption('margin-bottom', 45);
        $pdf->setOption('footer-html', $footerHtml);
        $path = base_path('public/storage/documentos/');
        $pdf_name = time().'.pdf';

        // $pdf -> save($path.$pdf_name);
        // return view('myPDF');
        return $pdf->stream($pdf_name);

    }
}
