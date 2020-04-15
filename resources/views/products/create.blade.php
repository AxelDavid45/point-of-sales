@extends('layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        Crear producto
                        <a class="btn btn-success btn-sm" href="{{ route('products.index')}}">
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
                        <form role="form">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Nombre del producto</label>
                                    <input type="text" class="form-control"
                                           value="{{ old('name') }}"
                                           name="name" placeholder="Nombre del producto" required>
                                </div>

                                <div class="form-group">
                                    <label for="category_id">Categoria del producto</label>
                                    <select required name="category_id" class="form-control">
                                        <option value="">Seleccione una opción</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->category_id }}">
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="price">Precio</label>
                                    <input type="number" min="1" name="price"
                                           class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="description">Descripción del
                                        producto (opcional)</label>
                                    <textarea class="form-control"
                                              name="description">{{ old('description') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="product_left">Producto en inventario
                                        (opcional)</label>
                                    <input type="number" min="1" name="product_left"
                                           class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="cost">Costo (opcional)</label>
                                    <input type="number" min="1" name="cost"
                                           class="form-control">
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button
                                    onclick="return confirm('¿Todos los datos son correctos?');"
                                    type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection

