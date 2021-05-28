<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>POS ZM | Iniciar sesión</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body
    style="background-image: url('https://images.unsplash.com/photo-1560250056-07ba64664864?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1934&q=80');
           background-position: center;
           background-size: cover;"
    class="hold-transition login-page">
<div class="login-box" style="opacity: 0.9;">
    <div class="login-logo">
    <h1 class="text-light bg-navy">POS-X</h1>
    </div>
    <div class="card">
        <div class="card-body login-card-body">

            <p class="login-box-msg">Inicia sesión para comenzar a vender</p>

            @if($errors->any())
                <div class="alert-danger">
                    @foreach($errors->all() as $error)
                        - {{ $error }}
                        @endforeach
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                <div class="input-group mb-3">
                    <input type="email" class="form-control" value="{{ old('email') }}"
                           placeholder="Correo" name="email" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" value="{{ old('password') }}" required
                           class="form-control"
                           placeholder="Contraseña" name="password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        @csrf
                        <input type="submit" class="btn btn-primary" value="Iniciar sesion">
                    </div>
                </div>
            </form>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://kit.fontawesome.com/4bc87b4ae7.js" crossorigin="anonymous"></script>

</body>
</html>
