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
                <div class="offset-4 col-2 text-center">
                    <h5>Vendido: <strong class="fa-2x">${{ $totalSalesPerDay }}</strong></h5>
                </div>
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
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->

                        <div class="card-body">
                            <div id="js-requests-messages">
                            </div>
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    @foreach($errors->all() as $error)
                                        - {{ $error }} <br>
                                    @endforeach
                                </div>
                            @endif
                            <form method="post" action="#"
                                  id="createSaleForm">
                                <div class="form-group">
                                    <label for="rfc">Cliente</label>
                                    <select id="rfc"  name="rfc" class="form-control">
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
                                            <th>Acción</th>
                                        </tr>
                                        </thead>
                                        <tbody id="cartTable">
                                        </tbody>
                                    </table>
                                </div>
                                <div class="form-group text-right">
                                    <h5>TOTAL $<span id="cartTotal" class="text-bold">0</span></h5>
                                </div>
                    <!-- /.card-body -->
                        <div class="card-footer">
                            @csrf
                            <button
                                type="submit" class="btn btn-primary">Guardar
                            </button>
                            <input type="hidden" id="user-id" value="{{ Auth::user()->id }}">
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tabla de productos</h3>

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
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody id="products-table">
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->product_id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>
                                <button class="btn btn-success btn-sm"
                                        data-name="{{ $product->name }}"
                                        data-price="{{ $product->price }}"
                                        data-id="{{ $product->product_id }}"
                                        data-left="{{ $product->product_left }}"
                                >
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

