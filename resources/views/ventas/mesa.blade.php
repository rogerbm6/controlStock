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

<a type="button" href="/ventas/productos/{{$venta->id}}" class="btn btn-sm btn-info m-1">
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
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#{{'v'.$key}}">
                                <i class="fa fa-dollar-sign"></i>Vender
                            </button>


                            <!-- Modal -->
                            <div class="modal fade" id="{{'v'.$key}}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Vender</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post">
                                                @csrf
                                                <input name="producto_id" type="hidden" value="{{$value['producto']->id}}">
                                                <div class="form-group p-2 text-justify">

                                                    <label for="cantidad">Cantidad</label>
                                                    <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="Cantidad">

                                                    <button type="submit" style="display:inline" class="mt-2 btn btn-sm btn-primary">guardar</button>
                                                </div>
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
