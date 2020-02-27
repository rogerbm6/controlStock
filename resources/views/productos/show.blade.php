@extends('layouts.master')

@section('content')

<a type="button" href="/productos" class="btn btn-sm btn-info m-1">
    <i class="fas fa-angle-left"></i> volver
</a>


<div class="col-md-11 m-2 p-2">
    <div class="card mb-5">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col-sm-2">
                    <h3 class="mb-0 text-uppercase">{{$tipo}}</h3>
                </div>
                <div class="col-sm-2">
                    <h3 class="mb-0 text-uppercase">Total :{{$total}}</h3>
                </div>
                <div class="col text-right d-inline p-1">
                    <button type="button" class="btn btn-sm btn-primary m-1" data-toggle="modal" data-target="#agregaProducto">
                        <i class="fa fa-plus-square" aria-hidden="true"></i>
                        Agregar
                    </button>

                    <div class="modal fade" id="agregaProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Agrega tu producto</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action='/productos/create'>
                                        @csrf
                                        <input name="tipo" type="hidden" value="{{$tipo}}">
                                        <div class="form-group p-2 text-justify">
                                            <label for="cantidad">Producto</label>
                                            <input type="text" name="nombre" class="form-control">

                                            <label for="cantidad">Precio</label>
                                            <input type="number" step="0.01" class="form-control" id="precio" name="precio" placeholder="precio">

                                            <button type="submit" class="mt-2 btn btn-sm btn-primary">guardar</button>
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
        <div class="table-responsive">
            <!-- Projects table -->
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Precio</th>
                        <th scope="col">Producto</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $producto)
                    <tr>
                        <td scope="row">
                            {{$producto->precio}}€
                        </td>
                        <th>
                            {{$producto->nombre}}
                        </th>
                        <td>
                            <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#{{'p'.$producto->id}}">
                                <i class="fas fa-edit"></i>editar
                            </button>


                            <!-- Modal -->
                            <div class="modal fade" id="{{'p'.$producto->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Editar producto</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="/productos/update">
                                                @csrf
                                                {{ method_field('PUT') }}
                                                <input name="producto_id" type="hidden" value="{{$producto->id}}">
                                                <div class="form-group p-2 text-justify">

                                                    <label for="cantidad">Nombre</label>
                                                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{$producto->nombre}}">

                                                    <input type="number" step="0.01" class="form-control my-2" id="precio" name="precio" value="{{$producto->precio}}">

                                                    <button type="submit" style="display:inline" class="mt-2 btn btn-sm btn-primary">guardar</button>
                                                </div>
                                            </form>
                                            <form action="/productos/delete" method="POST" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {!! csrf_field() !!}
                                            <input name="producto_id" type="hidden" value="{{$producto->id}}">
                                            <button type="submit" class="btn btn-sm btn-danger ml-2" style="display:inline">
                                                Borrar
                                            </button>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            LalaSlou
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@stop
