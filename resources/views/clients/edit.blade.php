@extends('layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        Editar un cliente
                        <a class="btn btn-success btn-sm" href="{{ route('clients.index')}}">
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
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post" action="{{ route('clients.update', $client) }}">
                            @method('PUT')
                            <div class="card-body">
                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        @foreach($errors->all() as $error)
                                            - {{ $error }} <br>
                                        @endforeach
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label for="rfc">RFC del cliente</label>
                                    <input type="text" class="form-control"
                                           value="{{ old('rfc', $client->rfc) }}"
                                           name="rfc" placeholder="RFC del cliente" required>
                                </div>

                                <div class="form-group">
                                    <label for="name">Razón social</label>
                                    <input type="text"
                                           value="{{ old('name', $client->name) }}"
                                           placeholder="Razon social"
                                           name="name" required class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="email">Correo electronico (opcional)</label>
                                    <input
                                        value="{{ old('email', $client->email) }}"
                                        type="email" name="email"
                                        class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="phone">Teléfono o celular (opcional)</label>
                                    <input
                                        value="{{ old('phone', $client->phone) }}"
                                        type="tel" class="form-control" name="phone">
                                </div>

                                <div class="form-group">
                                    <label for="address">Dirección (opcional)</label>
                                    <input
                                        value="{{ old('address', $client->address) }}"
                                        type="text" class="form-control" name="address">
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
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection

