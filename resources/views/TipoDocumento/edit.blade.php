@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="offset-4 col-md-4">
                {{ Form::model($tipo_documento, [
                    'route' => ['tipo-documentos.update', $tipo_documento->id],
                    'method' => 'put' ]) }}
                    <legend>Editar Tipo de Documento</legend>
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text"
                               class="form-control"
                               name="nombre"
                               value="{{$tipo_documento->nombre}}"
                               placeholder="Nombre...">
                    </div>
                    <div class="form-group">
                        <label>Descripcion</label>
                        <input type="text"
                               class="form-control"
                               name="descripcion"
                               value="{{$tipo_documento->descripcion}}"
                               placeholder="Descripcion...">
                    </div>
                    <button type="submit" class="btn btn-success">Actualizar</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
