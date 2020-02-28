@extends('layouts.master')

@section('content')

<div class="col-md-11 m-2 p-2">

    <div class="card mb-5">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Ventas</h3>
                </div>
                <div class="col">
                    <h3 class="mb-0">Total : €</h3>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <!-- Projects table -->
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Producto</th>
                        <th scope="col">Mesa</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Hora</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $productor)

                    <tr>
                        <th scope="row">
                            {{$producto['producto']->nombre ?? ''}}
                        </th>
                        <th>
                            {{$producto['mesa']->nombre ?? ''}}
                        </th>
                        <th>
                            {{$producto['cantidad'] ?? ''}}
                        </th>
                        <th>
                            {{$producto['producto']->precio ?? ''}}€
                        </th>
                        <th>
                            {{$producto['fecha']->vendido_en ?? ''}}
                        </th>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@stop
