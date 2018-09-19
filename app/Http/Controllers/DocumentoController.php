<?php

namespace App\Http\Controllers;

use Anouar\Fpdf\Fpdf;
use App\Documento;
use App\TipoDocumento;
use Illuminate\Http\Request;

class DocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $docs = Documento::join('tipo_documentos',
           'tipo_documentos.id',
           'documentos.tipo_documento_id')
           ->select('documentos.*',
                    'tipo_documentos.nombre as tipo_doc')
           ->get();
       return view('Documento.index', ['docs' => $docs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lista = TipoDocumento::orderBy('nombre')->get();
        return view('Documento/create',
                    ['tipo_documentos' => $lista]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->hasFile('url')) {
            $ruta = $request->file('url')->store('docs');
            $documento = new Documento();
            $documento->tipo_documento_id = $request->input('tipo_documento_id');
            $documento->nombre = $request->input('nombre');
            $documento->url = $ruta;
            $documento->save();
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function show(Documento $documento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $doc = Documento::find($id);
        return view('Documento/edit',
                    ['documento' => $doc]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Documento $documento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Documento::destroy($id);
        return back();
    }

    public function descargar($id){
        $url = Documento::find($id)->url;
        return response()
            ->download(storage_path('app/' . $url));
    }

    public function actualizar($id) {
        $documento = Documento::find($id);
        if (request()->hasFile('url')) {
            $url = request()->file('url')->store('docs');
            $documento->nombre = request()->input('nombre');
            $documento->url = $url;
        } else {
            $documento->nombre = request()->input('nombre');
        }
        $documento->save();
        return redirect('documentos');
    }

    private function anchoCol($registros, $titulos) {
        $ancho = [0,0,0];
        array_push($registros, [
            'tipo_documento_id' => $titulos[0],
            'nombre' => $titulos[1],
            'url' => $titulos[2],
        ]);
        foreach ($registros as $registro) {
            $col1 = strlen((string)$registro['tipo_documento_id']);
            $col2 = strlen((string)$registro['nombre']);
            $col3 = strlen((string)$registro['url']);
            $ancho[0] = $col1 > $ancho[0] ? $col1 : $ancho[0];
            $ancho[1] = $col2 > $ancho[1] ? $col2 : $ancho[1];
            $ancho[2] = $col3 > $ancho[2] ? $col3 : $ancho[2];
        }

        $ancho[0] = $ancho[0]*3;
        $ancho[1] = $ancho[1]*3;
        $ancho[2] = $ancho[2]*3;
        return $ancho;
    }
    public function generarReporte(){
        $titulos = [
            'Tipo de documento','nombre','url'
        ];
        $registros = Documento::orderBy('nombre')
                                ->get(['tipo_documento_id', 'nombre', 'url'])
                                ->toArray();
        $ancho = $this->anchoCol($registros, $titulos);
        $pdf = new Fpdf('L');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->AddPage();
        /*titulos*/
        $pdf->Cell($ancho[0],7,$titulos[0],1,0,'C',false);
        $pdf->Cell($ancho[1],7,$titulos[1],1,0,'C',false);
        $pdf->Cell($ancho[2],7,$titulos[2],1,0,'C',false);

        $pdf->Ln();
        $pdf->SetFont('Arial', '', 12);
        foreach($registros as $registro) {
            $pdf->Cell($ancho[0],6,$registro['tipo_documento_id'],1);
            $pdf->Cell($ancho[1],6,$registro['nombre'],1);
            $pdf->Cell($ancho[2],6,$registro['url'],1);
            $pdf->Ln();
        }
        $pdf->Output();
        exit;
    }


}
