@extends('voyager::master')


@section('page_title','ADD Rutas')

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-forward"></i> Añadir Rutas

        <a href="{{ route('voyager.organizacion.index') }}" class="btn btn-warning">
            <i class="glyphicon glyphicon-list"></i> <span class="hidden-xs hidden-sm"> Volver</span>
        </a>
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content edit-add container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">
                    <!-- form start -->
                   <form role="form" method="POST" action="{{ route('organizacion.rutas.update', $organizacion) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="panel-body">
                            <div class="head-form-title">
                                <i class="voyager-company"></i>
                                <h3>{{ $organizacion -> legal_name}}</h3>
                                <span style="font-weight: 500; color:white;">
                                    Nit: {{ $organizacion->nit}}
                                </span>
                            </div>
                            <div class="input-group">
                                <label for="routes" class="control-label">Seleccione la ruta</label>
                                <select name="routes" id="routes" class="form-control" required>
                                    <option value=""></option>
                                    @foreach ($rutas as $ruta)
                                        <option value="{{ $ruta->id }}">
                                            {{ strtoupper($ruta->full_route) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group">
                                <label for="shudown_resolution">Resolución (PDF):</label>
                                <input type="file" id="shudown_resolution" name="shudown_resolution" required>
                            </div>
                        </div>
                        <div class="panel-footer text-right">
                            <button class="btn btn-primary" type="submit">Guardar</button>
                        </div>
                    </form>
                    
                </div>
                @if ($organizacion->routes->count() > 0)
                    <div class="panel panel-bordered">
                        <div class="panel-body">
                            <h3>Rutas Asignadas</h3>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Ruta</th>
                                        <th>Resolución</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($organizacion->routes as $ruta)
                                        <tr>
                                            <td>{{ $ruta->full_route }}</td>

                                            <td>
                                                @if ($ruta->pivot->shudown_resolution)
                                                    <a class="label label-warning" style="text-decoration: none" href="{{ route('organizacion.rutas.download', ['organizacion' => $organizacion->id, 'ruta' => $ruta->id]) }}" target="_blank">
                                                        <i class="fa fa-file-pdf-o"></i>
                                                        Resolución
                                                    </a>
                                                @else
                                                        Sin resolución
                                                @endif
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal" data-route-id="{{ $ruta->id }}" data-action-url="{{ route('organizacion.rutas.destroy', ['organizacion' => $organizacion->id, 'ruta' => $ruta->id]) }}">
                                                    <i class="fa fa-angle-left"></i>
                                                    Desasociar ruta
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
                
            </div>
        </div>
    </div>

    <div class="modal modal-danger fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="deleteModalLabel">Desasociar ruta</h4>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que quieres desasociar esta ruta?
                </div>
                <div class="modal-footer">
                    <form method="POST" id="deleteForm">
                        @csrf
                        @method('DELETE')
    
                        <button type="submit" class="btn btn-danger pull-right delete-confirm">Desasociar ruta</button>
                    </form>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

@stop
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
    <style>
        .head-form-title{
            display: flex;
            align-items: center;
            gap: 1rem;
            background-color: #10d742;
            padding: 1rem;
            padding-left: 1.3rem; 
            margin-bottom: 1rem;
        }
        .head-form-title i{
            font-size: 1.3rem;
            color: #fff;
        }
        .head-form-title h3{
            color: #fff;
            margin: 0;
            font-size: 1.3rem;
            font-weight: 600;
        }
    </style>
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
            $('#deleteModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var actionUrl = button.data('action-url');
        
                var form = $(this).find('#deleteForm');
                form.attr('action', actionUrl);
            });
        });
    </script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var selectElement = document.getElementById('routes');
    
            selectElement.addEventListener('input', function() {
                var searchTerm = this.value.toLowerCase();
                var options = this.getElementsByTagName('option');
    
                for (var i = 0; i < options.length; i++) {
                    var optionText = options[i].textContent.toLowerCase();
                    var optionValue = options[i].getAttribute('value');
    
                    if (optionText.includes(searchTerm) || optionValue.includes(searchTerm)) {
                        options[i].style.display = '';
                    } else {
                        options[i].style.display = 'none';
                    }
                }
            });
        });
    </script>
    
  
@stop
