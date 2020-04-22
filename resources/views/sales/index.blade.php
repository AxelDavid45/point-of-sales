@extends('layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Ventas
                        <a class="btn btn-success btn-sm" href="{{ route('sales.create') }}">
                            <i class="fas fa-plus"></i>
                            Agregar una venta
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
            <div class="row">
                @foreach($sales as $sale)
                    <div class="col-3">
                        <div class="card">
                            <div class="card-header bg-dark">
                                    Vendido A: {{ $sale->client->name }}
                            </div>
                            <div class="card-body">
                                <h4>Total: $<strong>{{ $sale->total }}</strong></h4>
                                <p class="card-text">
                                    Fecha: {{ date_format($sale->created_at, 'd-M-Y') }}
                                </p>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-6">
                                        <form action="{{ route('products.destroy', $sale) }}"
                                              method="POST"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <input
                                            onclick="return confirm('¿Deseas eliminar este ' +
                                             'elemento?');"
                                            type="submit" value="Eliminar"
                                            class="btn btn-danger">
                                        </form>
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ route('sales.show', $sale) }}" class="btn
                                        btn-info">
                                            Detalles
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $sales->links() }}
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection

