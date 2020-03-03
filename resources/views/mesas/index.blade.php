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
        <h2 class="heading text-light">Gestion de mesas</h2>
        <div class="intro">Puedes administrar todas las mesas con tus productos</div>

      </div>
      <!--//container-->
    </section>
  </div>
</div>

<div class="row p-3">
  <div class="col-md-9 col-sm-12">
    @if ($errors->any())

    <div class="row justify-content-center">
      <div class="col-sm-12">
        <div class="alert alert-danger">
          <ul>
            @foreach($errors->all() as $error)
              <li>{{$error}}</li>
              @endforeach
          </ul>
        </div>
      </div>
    </div>
    @endif
    <div class="row">
      @foreach ($arrayMesas as $mesa)
      <div class="col-xl-3 col-md-6 col-sm-4">
        <div class="card card-stats">
          <!-- Card body -->
          <div class="card-body p-3">
            <div class="row">
              <div class="col-12">
                <span class="h2 font-weight-bold mb-0"><a href="/mesas/show/{{$mesa->id}}">{{$mesa->nombre}}</a></span>
              </div>
            </div>
            <p class="mt-3 mb-0 text-sm col-12">
              <span class="text-success mr-2 d-inline"></i>
                <button type="button" class="btn btn-sm btn-success text-right d-inline" data-toggle="modal" data-target="#{{'m'.$mesa->id}}">
                  <i class="fas fa-edit"></i>
                  Editar
                </button></span><br>


            </p>
            <!-- Modal -->
            <div class="modal fade" id="{{'m'.$mesa->id}}" tabindex="-1" role="dialog" aria-labelledby="{{'m'.$mesa->id}}" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body p-5">
                    <form method="post" enctype="multipart/form-data">
                      @csrf
                      {{method_field('PUT') }}
                      <input name="mesa_id" type="hidden" value="{{$mesa->id}}">
                      <div class="form-group  text-justify">
                        <label for="nombre">Cambiar nombre</label>

                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{$mesa->nombre}}">

                        <button type="submit" class="mt-2 btn btn-sm btn-primary">cambiar</button>
                      </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    LalaSlou
                  </div>
                </div>
              </div>
            </div>


          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>

  <div class="col-sm-12 col-md-3 my-5">
    <p>
      <a class="btn btn-primary" data-toggle="collapse" href="#NuevaMesa" aria-expanded="false" aria-controls="collapseExample">
        <i class="fa fa-plus-square" aria-hidden="true"></i>
        Nueva mesa
      </a>
    </p>

    <div class="collapse" id="NuevaMesa">
      <div class="card card-body">
        <form method="post" enctype="multipart/form-data" action='/mesas/create'>
          @csrf
          <div class="form-group p-2">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" name="nombre" placeholder="Nombre aqui" value="{{old('nombre')}}">

            <button type="submit" class="mt-2 btn btn-primary">guardar</button>
          </div>
        </form>

      </div>
    </div>
  </div>

</div>

<div class="m-5 ">
  {{$arrayMesas->links()}}
</div>
@stop
