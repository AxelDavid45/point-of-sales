<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>POS</title>

    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                        class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-sm-inline-block">
                <a href="{{ route('home') }}" class="nav-link text-bold text-info">Inicio</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button
                        onclick="return confirm('¿Estas seguro de cerrar sesión?')"
                        type="submit" class="btn btn-outline-danger">Cerrar sesión
                    </button>
                </form>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="/" class="brand-link">
            <span class="brand-text font-weight-light">POS ZM</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info">
                    <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">

                    <li class="nav-item">
                        <a href="{{ route('clients.index') }}" class="nav-link">
                            <i class="fa fa-user-friends nav-icon"></i>
                            <p>
                                Clientes
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('categories.index') }}" class="nav-link">
                            <i class="fa fa-tag nav-icon"></i>
                            <p>
                                Categorias
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('products.index') }}" class="nav-link">
                            <i class="fa fa-boxes nav-icon"></i>
                            <p>
                            Productos
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('sales.index') }}" class="nav-link">
                            <i class="nav-icon fa fa-sellsy"></i>
                            <p>
                                Ventas
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('reports.sales') }}" class="nav-link">
                            <i class="nav-icon fa fa-file-excel"></i>
                            <p>
                                Generar corte de caja
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="nav-link">
                            <i class="nav-icon fa fa-user"></i>
                            <p>
                                Nuevo usuario
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}" class="nav-link">
                            <i class="nav-icon fa fa-group"></i>
                            <p>
                                Todos los usuarios
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
    </div>

    <!-- Main Footer -->
    <footer class="main-footer no-print">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
            Point of sales from scratch
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; {{date('Y')}} <a href="https://twitter.com/E_Axel45">
                Developed by: Axel Espinosa
            </a>
            .</strong>
        All rights reserved.
    </footer>
</div>

<script src="https://kit.fontawesome.com/4bc87b4ae7.js" crossorigin="anonymous"></script>
<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
