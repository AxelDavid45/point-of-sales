@extends('layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        Registrar una venta
                        <a class="btn btn-success btn-sm" href="{{ route('sales.index')}}">
                            <i class="fas fa-backward"></i>
                            Regresar
                        </a>
                    </h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
            @if(session('created'))
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-success">
                            Creada correctamente
                        </div>
                    </div>
                </div>
            @endif
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5">
                    <div class="card card-primary">
                        <div class="card-header">
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post" action="{{ route('sales.store') }}">
                            <div class="card-body">
                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        @foreach($errors->all() as $error)
                                            - {{ $error }} <br>
                                        @endforeach
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label for="rfc">Cliente</label>
                                    <select required name="rfc" class="form-control">
                                        <option value="">Seleccione una opción</option>
                                        @foreach($clients as $client)
                                            <option value="{{ $client->rfc }}">
                                                {{ $client->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Cantidad</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>05</td>
                                            <td>Prueba</td>
                                            <td>
                                                <input type="number" class="form-control-sm"
                                                       value="1">
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                @csrf
                                <button
                                    onclick="return confirm('¿Todos los datos son correctos?');"
                                    type="submit" class="btn btn-primary">Guardar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Fixed Header Table</h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search"
                                           class="form-control float-right" placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default"><i
                                                class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0" style="height: 300px;">
                            <table class="table table-head-fixed text-nowrap">
                                <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Existencia</th>
                                    <th colspan="2">Acciones</th>
                                </tr>
                                </thead>
                                <tbody id="products-table">
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{ $product->product_id }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->product_left }}</td>
                                        <td>
                                            <button class="btn btn-success btn-sm">
                                                <i class="fas fa-plus"></i>
                                                Agregar
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection

