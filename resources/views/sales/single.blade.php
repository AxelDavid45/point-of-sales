@extends('layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Detalle de la venta: {{ $sale->sale_id }}
                        <a class="btn btn-success btn-sm" href="{{ route('sales.index')}}">
                            <i class="fas fa-backward"></i>
                            Regresar
                        </a>
                    </h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="invoice p-3 mb-3">
                <!-- title row -->
                <div class="row">
                    <div class="col-12">
                        <h4>
                            <i class="fas fa-receipt"></i> BEBIDAS EMBOTELLADAS DE CHIAPAS
                            <small class="float-right">Fecha: {{ date_format($sale->created_at,
                            'd-M-Y')
                            }}</small>
                        </h4>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        Vendido A:
                        <address>
                            <strong>{{ $sale->client->name }}</strong><br>
                            {{ $sale->client->rfc }}<br>
                            Dirección: {{ $sale->client->address }}<br>
                            Teléfono: {{ $sale->client->phone }}<br>
                            Correo: {{$sale->client->email}}
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        <b>Venta #{{$sale->sale_id}}</b><br>
                        <br>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- Table row -->
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Código</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($carts as $cart)
                            <tr >
                                <td>{{ $cart->product_id }}</td>
                                <td>{{ $cart->products[0]->name}}</td>
                                <td>{{ $cart->amount }}</td>
                                <td>{{ $cart->products[0]->price }}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <div class="row">
                    <!-- accepted payments column -->
                    <div class="col-6">
                    </div>
                    <!-- /.col -->
                    <div class="col-6">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th>Total:</th>
                                    <td>${{ $sale->total }}</td>
                                </tr>
                                </tbody></table>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->


            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection

