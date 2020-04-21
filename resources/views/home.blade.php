@extends('layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Inicio</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Agregar un producto</h5>

                            <p class="card-text">
                                Para poder agregar un producto nuevo, da clic al botón de
                                agregar nuevo.
                            </p>

                            <a href="{{ route('products.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i>
                                Agregar nuevo
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Realizar una venta</h5>

                            <p class="card-text">
                                Para poder realizar una venta da clic al boton de crear venta.
                            </p>

                            <a href="{{ route('sales.create') }}" class="btn btn-primary">
                                <i class="fas fa-cash-register"></i>
                                Crear Venta
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Corte de caja</h5>

                            <p class="card-text">
                                Para poder realizar el corte del día da clic al botón generar
                                corte de caja
                            </p>

                            <a href="#" class="btn btn-primary">
                                <i class="fas fa-file-excel"></i>
                                Generar corte de caja
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Agregar cliente</h5>

                            <p class="card-text">
                                Para poder agregar un cliente da clic al boton de agregar cliente
                            </p>

                            <a href="{{ route('clients.create') }}" class="btn btn-primary">
                                <i class="fas fa-user-plus"></i>
                                Agregar cliente
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection

