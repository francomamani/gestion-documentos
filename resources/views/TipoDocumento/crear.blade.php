@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="offset-4 col-md-4">
            @if($errors->any())
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Error </strong> en el ingreso de datos
                <ul>
                    @foreach($errors->all() as $error)
                    <li>
                        {{ $error }}
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
            {{ Form::open(['url'=>'tipo-documentos/store']) }}
                <legend>Crear Tipo de Documento</legend>
                <section class="form-group">
                    <label>Nombre</label>
                    <input type="text" class="form-control" name="nombre">
                    @if($errors->has('nombre'))
                        <span class="error"> {{ $errors->first('nombre') }} </span>
                    @endif
                </section>
                <section class="form-group">
                    <label>Descripcion</label>
                    <input type="text" class="form-control" name="descripcion">
                    @if($errors->has('descripcion'))
                        <span class="error"> {{ $errors->first('descripcion') }} </span>
                    @endif
                </section>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>
</div>
@endsection
