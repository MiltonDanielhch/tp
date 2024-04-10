@if ($asociados)
    <section>
        <div class="section-title" style="margin-top: 50px">
            <h2>Asociado</h2>
            <h3><span>Datos del Asociado</span></h3>
            @if (!isset($error))
            <p>La siguiente información muestra los datos del asociado sus vehiculos registrado.</p>
            @endif
        </div>

        @if (isset($error))
            <div class="row m-5">
                <div class="col-md-6">
                    <div class="panel-body" style="padding-top:0;">
                        <p>Documento de identificación</p>
                    </div>
                    <div class="panel-heading" style="border-bottom:0;">
                        <h3 class="panel-title">{{ $asociados->ci }} {{ $asociados->expedition_ci }}</h3>
                    </div>
                </div>

                <div class="col-md-6" style="text-align: right">
                    <div class="panel-body" style="padding-top:0;">
                        <p>Fecha registro</p>
                    </div>
                    <div class="panel-heading" style="border-bottom:0;">
                        <h5 class="panel-title">{{ date('d/m/Y H:i:s', strtotime($asociados->created_at)) }} <small>{{ \Carbon\Carbon::parse($asociados->created_at)->diffForHumans() }}</small></h5>
                    </div>
                </div>
                <hr>
            </div>

            <div class="row">
                <div class="col-md-12 text-center mt-3">
                    <img src="{{ asset('images/not-found.png') }}" width="150px" alt="Not Found">
                    <h3 class="text-muted mt-3">{{ $error }}</h3>
                </div>
            </div>

            <div class="row m-5">
                <div class="alert alert-danger">
                    El asociado con documento de identidad <strong>{{ $asociados->ci }} {{ $asociados->expedition_ci }}</strong> no se encuentra activo.
                </div>
            </div>
        @else
            <div class="row m-5">
                <div class="col-md-6">
                    <div class="panel-body" style="padding-top:0;">
                        <p>Documento de identificación</p>
                    </div>
                    <div class="panel-heading" style="border-bottom:0;">
                        <h3 class="panel-title">{{ $asociados->ci }} {{ $asociados->expedition_ci }}</h3>
                    </div>
                </div>

                <div class="col-md-6" style="text-align: right">
                    <div class="panel-body" style="padding-top:0;">
                        <p>Fecha registro</p>
                    </div>
                    <div class="panel-heading" style="border-bottom:0;">
                        <h5 class="panel-title">{{ date('d/m/Y H:i:s', strtotime($asociados->created_at)) }} <small>{{ \Carbon\Carbon::parse($asociados->created_at)->diffForHumans() }}</small></h5>
                    </div>
                </div>
                <hr>

                <div class="col-md-12 mt-1">
                    <b>Tipo de organización a la que pertenece: </b> &nbsp; {{ $asociados->organization->affiliation_type}}<br>
                    <b>Nombre de la organización a la que pertenece: </b> &nbsp; {{ $asociados->organization->legal_name}}<br>
                    <b>Nombre Completo: </b> &nbsp; {{ $asociados->full_name }}<br>
                    <b>Estado: </b> &nbsp; <span class="bg-success text-white" style="padding: 2px 5px"> Activo</span><br>
                    <b>Imagen: </b> &nbsp; <td style="text-align: center;"><img style="text-align: center" src="{{ asset('storage/'.$asociados->image) }}" alt="" height="100"></td> <br>
                </div>

            </div>

            <div class="row m-5">
                <div class="col-md-12">
                    <h4 style="text-decoration: underline">Vehiculos del Asociado</h4>
                </div>
            </div>

            <div class="row m-5">
                @if ($asociados->vehicles->count() > 0)
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                    <th scope="col"> </th>
                                    <th scope="col">Foto</th>
                                    <th scope="col">Clase</th>
                                    <th scope="col">Marca</th>
                                    <th scope="col">Año</th>
                                    <th scope="col">N° de Placa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($asociados->vehicles as $vehicle)
                                    <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td><img src="{{ asset('storage/'.$vehicle->photo) }}" alt="" height="100"></td>
                                    <td>{{ $vehicle->class }}</td>
                                    <td>{{ $vehicle->brand}}</td>
                                    <td>{{ $vehicle->year }}</td>
                                    <td>{{ $vehicle->number_plate }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <br>
                    </div>
                @else
                    <div class="col-md-12">
                        <div class="alert alert-warning">
                            El asociado no tiene vehiculos registradas.
                        </div>
                    </div>   
                @endif   
            </div>
    
            <div class="row m-5">
                <div class="col-md-12">
                    <h4 style="text-decoration: underline">Ruta de la organización</h4>
                </div>
            </div>
    
            <div class="row m-5">
                @if ($asociados->organization->routes->count() > 0)
                <div class="col-md-12">
                    <h4 style= "text-align: center" "text-decoration: underline">Ruta del Asociado</h4> <br>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                <th scope="col"> N°</th>
                                <th scope="col"> LOCALIDAD ORIGEN</th>
                                <th scope="col"> LOCALIDAD DESTINO</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($asociados->organization->routes as $route)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td style="text-transform: uppercase;"> <strong>Provincia:</strong> {{ $route->origin->province }}<strong> -- Ciudad: </strong> {{ $route->origin->municipality }}</td>
                                    <td style="text-transform: uppercase;"> <strong>Provincia:</strong>  {{ $route->destination->province }}<strong> -- Ciudad: </strong>{{$route->destination->municipality}}</td>
                                </tr>
                                @endforeach                                        
                            </tbody>
                        </table>
                    </div>
                    <br>
                </div>
                @else
                <div class="col-md-12">
                    <div class="alert alert-warning">
                        El asociado no tiene rutas registradas.
                    </div>
                </div>   
                @endif
            </div>
        @endif
        <hr>
    </section>
@else
    <section>
        <div class="section-title" style="margin-top: 50px">
            <h2>Asociado</h2>
            <h3><span style="color: red;">No encontrado</span></h3>
            <p>No se ha encontrado un asociado con esa información.</p>
        </div>
        <div class="row">
            <div class="col-md-12 text-center mt-3">
                <img src="{{ asset('images/not-found.png') }}" width="150px" alt="Not Found">
                <h3 class="text-muted mt-3"></h3>
            </div>
        </div>

        <div class="row m-5">
            <div class="alert alert-danger">
                No se ha encontrado un asociado con la información proporcionada.
            </div>
        </div>
        <hr>
    </section>
@endif