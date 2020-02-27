@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <section class="cta-section theme-bg-dark py-5 text-light">
            <div class="container text-center">
                <h2 class="heading text-light">Gestion de productos</h2>
                <div class="intro">Puedes administrar todos los productos que vendes (agregar o eliminar)</div>

            </div>
            <!--//container-->
        </section>
    </div>
</div>

<div class="row m-3">
    @foreach ($tipos as $tipo)
    <div class="col-xl-3 col-md-6">
        <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0"><a href="/productos/{{$tipo->tipo}}">{{$tipo->tipo}}</a></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

</div>


@stop
