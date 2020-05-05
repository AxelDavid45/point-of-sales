@extends('layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        Crear una categoria
                        <a class="btn btn-success btn-sm" href="{{ route('categories.index')}}">
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
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post" action="{{ route('categories.store') }}">
                            <div class="card-body">
                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        @foreach($errors->all() as $error)
                                            - {{ $error }} <br>
                                        @endforeach
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label for="name">Nombre de la categoria</label>
                                    <input type="text" class="form-control"
                                           value="{{ old('name') }}"
                                           name="name" placeholder="Nombre de la categoria"
                                           required>

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

