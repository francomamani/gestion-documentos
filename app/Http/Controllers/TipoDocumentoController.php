<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTipoDocumento;
use App\TipoDocumento;
use Illuminate\Http\Request;
use Khill\Lavacharts\Lavacharts;

class TipoDocumentoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')
             ->except([ 'cambiar',
                        'elegirGrafica',
                        'docsByTipoDocumento',
                        'documentos',
                        'documentos2']);
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

    private function elegirGrafica($tipo, $lava, $tabla, $config) {
        $grafica = null;
        switch ($tipo) {
            case "PieChart":
                $grafica = $lava->PieChart('PieChart', $tabla, $config);
                break;
            case "AreaChart" :
                $grafica = $lava->AreaChart('DonutChart', $tabla, $config);
                break;
            case "BarChart":
                $grafica = $lava->BarChart('BarChart', $tabla, $config);
                break;
            case "ColumnChart":
                $grafica = $lava->ColumnChart('ColumnChart', $tabla, $config);
                break;
            case "LineChart":
                $grafica = $lava->LineChart('LineChart', $tabla, $config);
                break;
            case "ScatterChart":
                $grafica = $lava->ScatterChart('ScatterChart', $tabla, $config);
                break;
        }
        return $grafica;
    }
    public function cambiar() {
        $grafica = request()->input('grafica');
        return $this->docsByTipoDocumento($grafica);
    }
    public function docsByTipoDocumento($tipo = 'PieChart') {
        $query = TipoDocumento::join('documentos',
                    'tipo_documentos.id',
                    'documentos.tipo_documento_id')
                 ->selectRaw('COUNT(documentos.nombre) as docs, 
                             tipo_documentos.nombre as tipo_doc')
                 ->groupBy('tipo_documentos.nombre')
   //              ->havingRaw('docs > 1')
                 ->get()
                 ->toArray();

        $lista = [];
        foreach ($query as $tipo_documento) {
            array_push($lista,
                        [
                            $tipo_documento['tipo_doc'],
                            $tipo_documento['docs']
                        ]);
        }

        $lava = new Lavacharts();
        $tabla = $lava->DataTable();
        $tabla->addStringColumn('tipo_doc');
        $tabla->addNumberColumn('docs');
        $tabla->addRows($lista);
        $config = [
            'title' => 'Cantidad de Documentos por Tipo',
            'width' => 800,
            'height' => 600
        ];
        $chart = $this->elegirGrafica($tipo, $lava, $tabla, $config);
/*        $chart = $lava->PieChart('docChart', $tabla, $config);*/
        $control  = $lava->NumberRangeFilter('docs',
                        [
                            'ui' =>
                                ['labelStacking' => 'horizontal']
                        ]);
        $chartWrapper = $lava->ChartWrapper($chart, 'chart');
        $controlWrapper = $lava->ControlWrapper($control, 'control');

        $lava->Dashboard('PanelControl', $tabla)
             ->bind($controlWrapper, $chartWrapper);
        return view('TipoDocumento/grafica', ['lava' => $lava]);

//        return response()->json($query, 200);
    }

    public function documentos($tipo_documento_id) {
        $documentos = TipoDocumento::find($tipo_documento_id)
                      ->documentos()
                      ->with('tipoDocumento')
                      ->get();
        return response()->json($documentos);
    }
    public function documentos2($tipo_documento_id) {
        $documentos = TipoDocumento::with('documentos')
                                    ->find($tipo_documento_id);
        return response()->json($documentos);

    }


}
