@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="offset-4 col-md-4">
                {{Form::open(['url'=>'documentos', 'files' => true])}}
                    <legend>Registrar Documento</legend>
                    <div class="form-group">
                        <label for="tipo_documento">Tipo de Documento</label>
                        <select name="tipo_documento_id"
                                class="form-control"
                                id="tipo_documento">
                            @foreach($tipo_documentos as $tipo_documento)
                            <option value="{{$tipo_documento->id}}">
                                {{ $tipo_documento->nombre }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control"
                               name="nombre" id="nombre" placeholder="Nombre">
                    </div>
                    <div class="form-group">
                        <label for="documento">Documento</label>
                        <input type="file" class="form-control"
                               name="url" id="documento">
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Guardar
                    </button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
