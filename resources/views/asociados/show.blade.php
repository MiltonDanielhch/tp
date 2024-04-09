@extends('frontend.welcome')

@section('content')
<main id="main">
    <div class="container" data-aos="fade-up">
        <div id="div-search"></div>
    </div>

    <section id="counts">
        <div class="section-title" style="margin-top: 50px">
            <h2>Asociado</h2>
            <h3><span>Datos del Asociado</span></h3>
            @if (!isset($error))
            <p>La siguiente información muestra los datos del asociado sus vehiculos registrado.</p>
            @endif
        </div>
        @if (isset($error))
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
                    <b>Estado: </b> &nbsp; <span class="bg-success text-white" style="padding: 2px 5px"> Activo</span>
                </div>
                
            </div>

            <div class="row m-5">
                <div class="col-md-12">
                    <h4 style="text-decoration: underline">Vehiculos del Asociado</h4>
                </div>
            </div>
            

            {{-- <ul class="timeline">
                    <li class="timeline-inverted">
                        <div class="timeline-badge primary"><i class="bi bi-check-lg"></i></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title"> Hola</h4>
                                <h6>hola| <small>hola</small></h6>
                            </div>
                            <div class="timeline-body">
                                <p>hola</p>
                            </div>
                        </div>
                    </li>
            </ul> -
            --}}

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
                @endif
            </div>

        @endif
        <hr>
    </section>

     <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Contácto</h2>
                <h3><span>Contáctate con nosotros</span></h3>
                <p>Para obtener más información puedes contactarnos por medio de cualquiera de los canales de comunicación descritos a continuación.</p>
            </div>

            <div class="row mt-5" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-6 ">
                    <iframe class="mb-4 mb-lg-0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d964.2034342454992!2d-64.90438077082753!3d-14.83570830295541!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x93dd6fd5b87370df%3A0x47918f6983c7c6c8!2sGobierno%20Aut%C3%B3nomo%20Departamental%20Del%20Beni!5e0!3m2!1ses-419!2sbo!4v1626364207037!5m2!1ses-419!2sbo" frameborder="0" style="border:0; width: 100%; height: 360px;" allowfullscreen></iframe>
                </div>

                <div class="col-lg-6">
                    <div class="row" data-aos="fade-up" data-aos-delay="100">
                        <div class="col-lg-12">
                            <div class="info-box mb-4">
                            <i class="bx bx-map"></i>
                            <h3>Nuestra Dirección</h3>
                            <p>{{ setting('site.direccion') }}</p>
                            </div>
                        </div>
    
                        <div class="col-lg-6 col-md-12">
                            <div class="info-box  mb-4">
                            <i class="bx bx-envelope"></i>
                            <h3>Nuestros Email</h3>
                            <p>{{ setting('site.email') }}</p>
                            </div>
                        </div>
    
                        <div class="col-lg-6 col-md-12">
                            <div class="info-box  mb-4">
                            <i class="bx bx-phone-call"></i>
                            <h3>Llámanos</h3>
                            <p>{{ setting('site.telefono') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section><!-- End Contact Section -->
    
</main><!-- End #main --> 
</section>
<!-- End Hero -->


@endsection