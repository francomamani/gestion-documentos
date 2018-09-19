@extends('layouts.app')
@section('content')
    <div class="container row">
        <div class="offset-4 col-md-4">
            {{ Form::open(['url'=> 'documentos/actualizar/' . $documento->id, 'files' => true]) }}
                <legend>Editar Documento</legend>

                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control"
                           value="{{$documento->nombre}}"
                           name="nombre" id="nombre">
                </div>
                <div class="form-group">
                    Cambiar documento
                    <input type="checkbox"
                           id="con_documento"
                           checked
                           oninput="mostrar2()"
                           name="con_documento">
                </div>
                <div class="form-group show" id="doc-group">
                    <label for="doc">documento</label>
                    <input type="file" class="form-control"
                           name="url" id="doc">
                </div>
                <button type="submit" class="btn btn-success">Actualizar</button>
            {{ Form::close() }}
        </div>
    </div>
    <script>
        function mostrar() {
            var valor = document.getElementById('con_documento').checked;
            var docGroup = document.getElementById('doc-group');
            if(valor == true) {
                docGroup.classList.remove('hide');
                docGroup.classList.add('show');
            } else {
                docGroup.classList.remove('show');
                docGroup.classList.add('hide');
            }
        }
        function mostrar2() {
            var valor = document.getElementById('con_documento').checked;
            var docGroup = document.getElementById('doc-group');
            docGroup.style.display = valor ? 'block': 'none';
        }
    </script>
@endsection
