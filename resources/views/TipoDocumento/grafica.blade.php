@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <form
                method="post"
                action="{{ url('cambiar') }}"
                class="form-inline">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="grafica">Grafica</label>
                    <select name="grafica" id="grafica" class="form-control">
                        <option value="PieChart">Torta</option>
                        <option value="AreaChart">Area</option>
                        <option value="BarChart">Barras</option>
                        <option value="ColumnChart">Histograma</option>
                        <option value="LineChart">Poligono de Frecuencias</option>
                        <option value="ScatterChart">Nube de puntos</option>
                    </select>
                </div>
                <button class="btn btn-success">Cambiar</button>
            </form>
        </div>
    </div>
    <div id="panelControl">
        <div id="control"></div>
        <div id="chart"></div>
    </div>
    <?=
    /*
     *Parametros
     * 1: Dashboard (Tipo de grafica o contenedor de graficas)
     * 2: Nombre del tipo de grafica
     * 3: id donde se va a renderizar
     * */
    $lava->render('Dashboard','PanelControl', 'panelControl');
    ?>
</div>
@endsection
