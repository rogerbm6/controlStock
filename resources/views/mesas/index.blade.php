@extends('layouts.master')

@section('content')


<div class="row p-3">
    <div class="col-md-9 col-sm-12">

        <div class="row">
            @foreach ($arrayMesas as $mesa)
            <div class="col-xl-3 col-md-6 col-sm-4">
                <div class="card card-stats">
                    <!-- Card body -->
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col">
                                <span class="h2 font-weight-bold mb-0"><a href="/mesas/show/{{$mesa->id}}">{{$mesa->nombre}}</a></span>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-sm">
                            <span class="text-success mr-2"></i>{{$mesa->id}}</span><br>
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="col-sm-12 col-md-3 my-5">
        <p>
            <a class="btn btn-primary" data-toggle="collapse" href="#NuevaMesa" aria-expanded="false" aria-controls="collapseExample">
                Nueva mesa
            </a>
        </p>
        <div class="collapse" id="NuevaMesa">
            <div class="card card-body">
                <form method="post" action='/mesas/create'>
                  @csrf
                    <div class="form-group p-2">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" name="nombre" placeholder="Nombre aqui">

                        <button type="submit" class="mt-2 btn btn-primary">guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</div>

@stop
