@extends('layouts.master')

@section('content')

<a type="button" href="/mesas" class="btn btn-sm btn-info m-1">
    <i class="fas fa-angle-left"></i> volver
</a>

<div class="col-md-11 m-2 p-2">

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
    <div class="card mb-5">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">{{$mesa->nombre}}</h3>
                </div>
                <div class="col text-right d-inline p-1">
                    <button type="button" class="btn btn-sm btn-primary m-1" data-toggle="modal" data-target="#agregaProducto">
                        <i class="fa fa-plus-square" aria-hidden="true"></i>
                        Agregar
                    </button>

                    <!-- Modal -->
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
                                    <form method="post" action='/mesas/createProductoMesa'>
                                        @csrf
                                        <input name="mesa_id" type="hidden" value="{{$mesa->id}}">
                                        <div class="form-group p-2 text-justify">
                                            <label for="cantidad">Producto</label>
                                            <select class="custom-select" name="producto_id">
                                                <option selected>Escoge uno</option>
                                                @foreach ($allProductos as $producto)
                                                <option value="{{$producto->id}}">{{$producto->precio}}€ ---- {{$producto->nombre}}----{{$producto->tipo}}</option>
                                                @endforeach
                                            </select>

                                            <label for="cantidad">Cantidad</label>
                                            <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="Cantidad" value="{{old('cantidad')}}">

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

                    <button class="align-items-center pt-1 text-right btn btn-sm btn-danger m-1" data-toggle="modal" data-target="#borraTabla"><i class="fa fa-trash" aria-hidden="true"></i>
                        Borrar</button>


                    <!-- Modal -->
                    <div class="modal fade" id="borraTabla" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">¿Estás seguro de eliminar esta mesa?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body align-items-center text-left">
                                  <form action="{{action('MesasController@deleteMesa',$mesa->id)}}" method="POST" style="display:inline">
                                  {{ method_field('DELETE') }}
                                  @csrf
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
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <!-- Projects table -->
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Precio</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $key => $value)


                    <tr>
                        <td scope="row">
                            {{$value['producto']->precio}}€
                        </td>
                        <th>
                            {{$value['producto']->tipo}}
                        </th>
                        <th>
                            {{$value['producto']->nombre}}
                        </th>
                        <td>
                            {{$value['cantidad']}}
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#{{'u'.$key}}">
                                <i class="fas fa-edit"></i>editar
                            </button>


                            <!-- Modal -->
                            <div class="modal fade" id="{{'u'.$key}}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edita cantidad</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post">
                                                @csrf
                                                {{ method_field('PUT') }}
                                                <input name="producto_id" type="hidden" value="{{$value['producto']->id}}">
                                                <div class="form-group p-2 text-justify">

                                                    <label for="cantidad">Cantidad</label>
                                                    <input type="number" class="form-control" id="cantidad" name="cantidad" value="{{$value['cantidad']}}" placeholder="Cantidad">

                                                    <button type="submit" style="display:inline" class="mt-2 btn btn-sm btn-primary">guardar</button>
                                                </div>
                                            </form>
                                            <form action="{{action('MesasController@deleteProductoMesa',$mesa->id)}}" method="POST" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {!! csrf_field() !!}
                                            <input name="producto_id" type="hidden" value="{{$key}}">
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
