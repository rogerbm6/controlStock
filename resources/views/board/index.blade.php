@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <section class="cta-section theme-bg-dark py-5 text-light">
            <div class="container text-center">
                <h2 class="heading text-light">Inicio de administracion</h2>
                <div class="intro">Puedes ver los resumenes de ventas</div>

            </div>
            <!--//container-->
        </section>
    </div>
</div>

<div class="row p-3">
    <div class="col-md-3 col-sm-6 ">
        <ul class="list-group">
            @foreach ($arrayMesas as $mesa)

            <li class="list-group-item"><a href="/mesas/show/{{$mesa->id}}">{{$mesa->nombre}}</a>
            </li>

            @endforeach
        </ul>
    </div>
    <div class="col-md-9 col-sm-6">

        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card card-stats">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Total ventas</h5>
                                <span class="h2 font-weight-bold mb-0">{{$dia}}</span>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-sm">
                            <span class="text-success mr-2"></i>{{date('j-n-Y')}}</span><br>
                            <span>ventas actuales</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card card-stats">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Ventas del mes</h5>
                                <span class="h2 font-weight-bold mb-0">{{$mes}}</span>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-sm">
                            <span class="text-success mr-2">{{date('n-Y')}}</span><br>
                            <span>vendido el ultimo mes</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card card-stats">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">TOTAL ANUAL</h5>
                                <span class="h2 font-weight-bold mb-0">{{$ano}}</span>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-sm">
                            <span class="text-success mr-2">año {{date('Y')}}</span><br>
                            <span>vendido en el año</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card card-stats">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">productos</h5>
                                <span class="h2 font-weight-bold mb-0">{{$productos}}</span>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-sm">
                            <span class="text-success mr-2">En stock</span><br>
                            <span>para vender</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


@stop
