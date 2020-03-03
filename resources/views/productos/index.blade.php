{{-- Copyright (c) 2020 <YOUR NAME>

GNU GENERAL PUBLIC LICENSE
   Version 3, 29 June 2007

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>. --}}
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
