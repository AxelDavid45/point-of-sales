<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>POS ZM | Iniciar sesión</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        .body {


        }
    </style>
</head>
<body
    style="background-image: url('https://images.unsplash.com/photo-1536939459926-301728717817?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80');
           background-position: center;
           background-size: cover;"
    class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <img style="width: 100%" src="https://kandmaster.com/logotipo.png" alt="">
    </div>
    <!-- /.login-logo -->
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
                        <input type="submit" class="btn btn-dark" value="Iniciar sesion">
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col">
                    <a href="https://unsplash.com/photos/OTDyDgPoJ_0" class="text-muted text-sm">Photo
                        by
                        Jonathan
                        Chng</a>
                </div>
            </div>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://kit.fontawesome.com/4bc87b4ae7.js" crossorigin="anonymous"></script>

</body>
</html>
