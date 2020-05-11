@extends('layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Categorias
                        <a class="btn btn-success btn-sm" href="{{ route('categories.create') }}">
                            <i class="fas fa-plus"></i>
                            Agregar una categoria
                        </a>
                    </h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
            @if(isset($_SESSION['deleted']))
                <div class="row">
                    <div class="alert alert-success">
                        Eliminada correctamente
                    </div>
                </div>
            @endif
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            {{ $categories->links() }}
            <div class="row">
                @foreach($categories as $category)
                    <div class="col-sm-12 col-md-3">
                        <div class="card">
                            <div class="card-header bg-dark">
                                Codigo: {{ $category->category_id }}
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $category->name }}</h5>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-6">
                                        <form action="{{ route('categories.destroy', $category) }}"
                                              method="POST"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <input
                                            onclick="return confirm('¿Deseas eliminar este ' +
                                             'elemento? Si eliminas este elemento se eliminara ' +
                                              'todos los productos relacionados a esta categoria');"
                                            type="submit" value="Eliminar"
                                            class="btn btn-danger">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $categories->links() }}
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection

