@extends('layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        Ediar un producto
                        <a class="btn btn-success btn-sm" href="{{ route('products.index')}}">
                            <i class="fas fa-backward"></i>
                            Regresar
                        </a>
                    </h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
            @if(session('updated'))
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-success">
                            Editado correctamente
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
                        <form method="post" action="{{ route('products.update', $product) }}">
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
                                    <label for="name">Nombre del producto</label>
                                    <input type="text" class="form-control"
                                           value="{{ old('name', $product->name) }}"
                                           name="name" placeholder="Nombre del producto" required>
                                </div>

                                <div class="form-group">
                                    <label for="category_id">Categoria del producto</label>
                                    <select required name="category_id" class="form-control">
                                        @foreach($categories as $category)
                                            @if($category->category_id == $product->category_id)
                                                <option selected value="{{ $category->category_id }}">
                                                    {{ $category->name }}
                                                </option>
                                            @else
                                                <option value="{{ $category->category_id }}">
                                                    {{ $category->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="price">Precio</label>
                                    <input type="number" min="1" value="{{ old('price',
                                    $product->price) }}"
                                           name="price"
                                           class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="description">Descripción del
                                        producto (opcional)</label>
                                    <textarea class="form-control"
                                              name="description">{{ old('description',
                                              $product->description)
                                              }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="product_left">Producto en inventario
                                        (opcional)</label>
                                    <input type="number" min="1" name="product_left"
                                           class="form-control" value="{{ old('product_left',
                                    $product->product_left) }}">
                                </div>

                                <div class="form-group">
                                    <label for="cost">Costo (opcional)</label>
                                    <input type="number" min="1"
                                           name="cost"
                                           value="{{ old('cost',
                                    $product->cost) }}"
                                           class="form-control">
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

