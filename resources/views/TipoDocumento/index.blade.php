@extends('layouts.app')
@section('content')
<div class="container">
    {{ Form::open(['url' => 'tipo-documentos/buscar',
            'class' => 'form-inline' ]) }}
    <div class="form-group">
        <label class="sr-only" for="">label</label>
        <input type="search"
               class="form-control"
               name="campo"
               placeholder="Buscar...">
    </div>
    <button type="submit" class="btn btn-primary">Buscar</button>
    {{ Form::close() }}
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                <tr>
                    <th>
                        #
                    </th>
                    <th>
                        Nombre
                    </th>
                    <th>
                        Descripcion
                    </th>
                    <th>
                        Acciones
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($lista as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->nombre }}</td>
                        <td>{{ $item->descripcion }}</td>
                        <td>
                            <div class="row">
                                <div class="col-md-2">
                                    <a href="{{ URL::to('tipo-documentos/edit/' . $item->id) }}"
                                       class="btn btn-sm btn-info">
                                        Editar
                                    </a>
                                </div>
                                <div class="col-md-2">
                                    {{ Form::open([
                                        'url'=>'tipo-documentos/destroy/' . $item->id,
                                        'method' => 'delete']) }}
                                    <button class="btn btn-sm btn-danger">Eliminar</button>
                                    {{Form::close()}}
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
