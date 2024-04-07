@extends('voyager::master')


@section('page_title','ADD Rutas')

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-forward"></i> Añadir Rutas
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content edit-add container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">
                    <!-- form start -->
                    <form role="form">
                        <div class="panel-body">
                            <div class="input-group">
                                <label for="routes" class="control-label">Seleccione la ruta</label>
                                <select name="routes" id="routes" class="form-control" required>
                                    @foreach ($rutas as $ruta)
                                        <option value=""></option>
                                        <option value="{{ $ruta->id }}">
                                            {{ strtoupper($ruta->full_route) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group">

                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
@stop
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
    <style>
        .input-group {
            width: 100%;
            margin-bottom: 10px;
        }
        .input-group label {
            display: block;
        }
        .input-group select {
            width: 100%;
        }
    </style>
@stop
@section('javascript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#routes').select2({
            matcher: function(params, data) {
                // Si no hay término de búsqueda, devuelve todos los datos
                if ($.trim(params.term) === '') {
                    return data;
                }
                // No devuelve el dato si no hay 'text' para comparar
                if (typeof data.text === 'undefined') {
                    return null;
                }
                // `params.term` debería ser la cadena de búsqueda sin espacios al final
                // `data.text` es la opción del select
                if (data.text.toLowerCase().indexOf($.trim(params.term).toLowerCase()) > -1) {
                    return data;
                }
                // Retorna `null` si el término de búsqueda no está incluido en la opción del select
                return null;
            }
        });
    });
    </script>
@stop