@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ url('generar-reporte') }}"
                      method="post">
                    {{ csrf_field() }}
                    <button
                        type="submit"
                        class="btn btn-lg btn-success">Generar PDF</button>
                </form>
                <br><br>
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>N.</th>
                        <th>Tipo Documento</th>
                        <th>Documento</th>
                        <th>Archivo</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($docs as $doc)
                    <tr>
                        <td>{{ $doc->id }}</td>
                        <td>{{ $doc->tipo_doc }}</td>
                        <td>{{ $doc->nombre }}</td>
                        <td>
                            <a href="{{ url('documento-descargar/'. $doc->id) }}">Descargar</a>
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-md-3">
                                    <a  href="{{ url('documentos/'. $doc->id .'/edit') }}"
                                        class="btn btn-sm btn-info">
                                        Editar
                                    </a>

                                </div>
                                <div class="col-md-3">
                                    {{ Form::open(['url' => 'documentos/'. $doc->id,
                                                   'method'=>'delete']) }}
                                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                    {{ Form::close() }}
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
