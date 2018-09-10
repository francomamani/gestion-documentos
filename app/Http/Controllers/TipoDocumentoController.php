<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTipoDocumento;
use App\TipoDocumento;
use Illuminate\Http\Request;

class TipoDocumentoController extends Controller
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
        $lista = TipoDocumento::orderBy('nombre', 'desc')->get();
        return view('TipoDocumento/index', ['lista' => $lista]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('TipoDocumento/crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTipoDocumento $request)
    {
        TipoDocumento::create($request->all());
//        return back();
        return redirect('tipo-documentos/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TipoDocumento  $tipoDocumento
     * @return \Illuminate\Http\Response
     */
    public function show(TipoDocumento $tipoDocumento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TipoDocumento  $tipoDocumento
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipo_documento = TipoDocumento::find($id);
        return view('TipoDocumento/edit', [
            'tipo_documento' => $tipo_documento
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TipoDocumento  $tipoDocumento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tipo_documento = TipoDocumento::find($id);
        $tipo_documento->update($request->all());
        return redirect('tipo-documentos/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TipoDocumento  $tipoDocumento
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipo_documento = TipoDocumento::find($id);
        $tipo_documento->delete();
        return redirect('tipo-documentos/index');
    }

    public function buscar(){
        $campo = request()->input('campo');
        $lista = TipoDocumento::where('nombre', 'like', '%'.$campo.'%')
                        ->orWhere('descripcion', 'like', '%'.$campo.'%')
                        ->orderBy('nombre')
                        ->get();
        return view('TipoDocumento/index', ['lista' => $lista]);
    }



}
